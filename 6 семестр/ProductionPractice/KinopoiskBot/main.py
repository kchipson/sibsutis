# -*- coding: utf-8 -*-
import asyncio
import os
from dotenv import load_dotenv, find_dotenv
import logging
from aiogram import Bot, Dispatcher, executor, types
from aiogram.dispatcher import FSMContext
from aiogram.contrib.fsm_storage.memory import MemoryStorage
from aiogram.dispatcher.filters.state import State, StatesGroup
import emoji
import keyboards
import kinopoisk_api
from telegraph import Telegraph

# Логирование
logging.basicConfig(level=logging.INFO, format="%(asctime)s - %(levelname)s - %(name)s - %(message)s")

# Токен  из переменной окружения
load_dotenv(find_dotenv())
bot_token = os.environ.get("TELEGRAM_TOKEN")
if not bot_token:
    exit("Error: Переменная \"TELEGRAM_TOKEN\" не найдена в переменных окружения")
api_key = os.environ.get("API_KEY")
if not api_key:
    exit("Error: Переменная \"API_KEY\" не найдена в переменных окружения")


class DataInput(StatesGroup):
    searchFilm = State()
    seacrhHuman = State()


# Объект бота
bot = Bot(token=bot_token, parse_mode=types.ParseMode.MARKDOWN_V2)

# Диспетчер для бота
dp = Dispatcher(bot, storage=MemoryStorage())

# Api
kinopoisk = kinopoisk_api.KinopoiskApi(token=api_key)


# Хэндлер на команду /start
@dp.message_handler(commands=["start"], state="*")
async def cmd_start(message: types.Message, state: FSMContext):
    await state.finish()
    me = await bot.get_me()
    await message.answer(f"Добро пожаловать, *{message.from_user.full_name}{emoji.emojize(':star:')}*\n"
                         f"\n"
                         f"{emoji.emojize(':cinema:')} Я {me.full_name} и я могу:\n"
                         f"\~ Найти фильм/сериал\n"
                         f"\~ Найти актера\n"
                         f"\~ Вывести топ50\n"
                         f"\~ Предложить случайный фильм\n"
                         f"\n"
                         f"{emoji.emojize(':information:')} _Если хочешь узнать больше обо мне_ \- /help\n"
                         f"\n"
                         f"{emoji.emojize(':red_exclamation_mark:')} _Если не появилась клавиатура_ \- /menu\n",
                         reply_markup=keyboards.mainKeyboard)


# Хэндлер на команду /menu
@dp.message_handler(commands=['menu'], state="*")
async def cmd_menu(message: types.Message, state: FSMContext):
    await state.finish()
    await message.answer("Основное меню", reply_markup=keyboards.mainKeyboard)


# Хэндлер на команду /help
@dp.message_handler(commands=['help'], state="*")
async def cmd_help(message: types.Message, state: FSMContext):
    await state.finish()
    await message.answer("<i>Список доступных команд:</i>\n\n"
                         "<b>/start</b> - Перезапуск бота\n"
                         "<b>/film</b> - Поиск фильма\n"
                         "<b>/human</b> - Поиск человека\n"
                         "<b>/random</b> - Случайный фильм\n"
                         "<b>/top50</b> - Топ-50 лучших фильмов\n"
                         "<b>/cancel</b> - Отменить текущее действие\n"
                         "<b>/menu</b> - Отобразить клавиатуру\n"
                         "<b>/hide</b> - Скрыть клавиатуру\n"
                         "<b>/help</b> - Помощь",
                         parse_mode=types.ParseMode.HTML)


# Хэндлер на команду /hide
@dp.message_handler(commands=['hide'], state="*")
async def cmd_cancel(message: types.Message, state: FSMContext):
    await message.answer("Клавиатура скрыта", reply_markup=keyboards.hideKeyboard)


# Хэндлер на команду /cancel
@dp.message_handler(commands=['cancel'], state=[DataInput.seacrhHuman, DataInput.searchFilm])
@dp.message_handler(lambda message: message.text == keyboards.cancelKey, state=[DataInput.seacrhHuman, DataInput.searchFilm])
async def cmd_cancel(message: types.Message, state: FSMContext):
    await state.finish()
    await message.answer("Действие отменено", reply_markup=keyboards.mainKeyboard)


@dp.callback_query_handler(text="cancel_button", state=[DataInput.seacrhHuman, DataInput.searchFilm])
async def callbacks_cancel(call: types.CallbackQuery, state: FSMContext):
    await state.finish()
    await call.message.delete_reply_markup()
    await call.message.answer("Действие отменено", reply_markup=keyboards.mainKeyboard)


# ------------


# Хэндлер на команду /film
@dp.message_handler(commands=['film'], state="*")
@dp.message_handler(lambda message: message.text == keyboards.MainKey.searchFilm)
async def cmd_film(message: types.Message, state: FSMContext):
    await state.finish()
    await message.reply(f"Введите название интересующего вас фильма/сериала", reply_markup=keyboards.cancelKeyboard)
    await DataInput.searchFilm.set()


# Хэндлер на команду /human
@dp.message_handler(commands=['human'], state="*")
@dp.message_handler(lambda message: message.text == keyboards.MainKey.searchActor)
async def cmd_human(message: types.Message, state: FSMContext):
    await state.finish()
    await message.reply(f"Введите имя интересующего вас человека", reply_markup=keyboards.cancelKeyboard)
    await DataInput.seacrhHuman.set()


# Хэндлер на команду /random
@dp.message_handler(commands=['random'], state="*")
@dp.message_handler(lambda message: message.text == keyboards.MainKey.randomFilm)
async def cmd_random(message: types.Message, state: FSMContext):

    await message.answer("Выполняю...", reply_markup=keyboards.hideKeyboard, parse_mode=types.ParseMode.HTML)
    film = await kinopoisk.get_random_film()

    text = ""
    if film.ru_name:
        text += f"{film.ru_name} ({film.name})"
    else:
        text += f"{film.name}"
    text += f"    {film.year}\n" if film.year else "\n"
    text += f"<i>{film.genres}</i>\n" if film.genres else ""
    text += f"\n<b>{film.description[:100]}...</b>\n" if film.description else ""

    text += f"\nРейтинг: {film.kp_rate}\n" if film.kp_rate else ""
    text += f"Рейтинг IMBD: {film.imdb_rate}\n" if film.imdb_rate else ""
    text += f"\n<b>Более подробнее: {film.url}</b>" if film.url else ""
    await state.finish()
    await bot.send_photo(message.from_user.id, film.poster, text, reply_markup=keyboards.mainKeyboard, parse_mode=types.ParseMode.HTML)


# Хэндлер на команду /top50
@dp.message_handler(lambda message: message.text == keyboards.MainKey.top500Film)
@dp.message_handler(commands=['top50'], state="*")
async def cmd_top(message: types.Message, state: FSMContext):
    await message.answer("Выполняю...", reply_markup=keyboards.hideKeyboard, parse_mode=types.ParseMode.HTML)
    films = await kinopoisk.top250_films()
    html = ''
    for i in enumerate(films[:50]):
        index = i[0] + 1
        data = i[1]
        star = ':star:'
        html += f"<p>{index}. <a href='{data.url}'>{f'{data.ru_name} ({data.name})' if data.ru_name else f'{data.name}'}</a>" \
                f"{f'    {data.year}<br>' if data.year else ''}" \
                f"{f'<i>{data.genres}</i><br>' if data.genres else ''}" \
                f"{f'{emoji.emojize(star)}Рейтинг: {data.kp_rate}<br>' if data.kp_rate else ''}" \
                f"<a href='{data.url}'><img src='{data.poster_preview}' height='100' alt='lorem'></a></p> <hr>"
    telegraph = Telegraph()
    telegraph.create_account(short_name=(await bot.get_me()).full_name)
    response = telegraph.create_page(
        f"{emoji.emojize(':star:')} Топ-50 фильмов",
        html_content=html
    )
    await state.finish()
    await message.answer(f"[{emoji.emojize(':star:')} Топ\-50 фильмов](https://telegra.ph/{response['path']})",
                         parse_mode=types.ParseMode.MARKDOWN_V2,
                         disable_web_page_preview=True,
                         reply_markup=keyboards.mainKeyboard
                         )


# ------------


# Поиск фильма
@dp.message_handler(state=DataInput.searchFilm)
async def film(message: types.Message, state: FSMContext):
    await message.answer("Выполняю...", reply_markup=keyboards.hideKeyboard, parse_mode=types.ParseMode.HTML)
    films = await kinopoisk.search_film(message.text)

    if films["result"] is None:
        await message.answer(f"{emoji.emojize(':warning:')}ERROR 404\nНичего не найдено\n Попробуйте поискать иначе",
                             reply_markup=keyboards.cancelKeyboard)
    else:
        text = ""
        text += f"Поиск - \"{films['query']}\"    Найдено - \"{films['numResults']}\"\n\n"
        for i in enumerate(films["result"]):
            index = i[0] + 1
            film = i[1]
            text += f"{index}.  <a href='{film.url}'>"
            if film.ru_name:
                text += f"{film.ru_name} ({film.name})"
            else:
                text += f"{film.name}"
            text += f"</a>     {film.year}\n" if film.year else "\n"
            text += f"<i>{film.genres}</i>\n" if film.genres else ""
            text += f"\nРейтинг: {film.kp_rate}" if film.kp_rate else ""
            text += f"  (IMBD: {film.imdb_rate})\n" if film.imdb_rate else ""
            text += f"\n---\n\n"
        text += f"Все результаты поиска: {films['resultUrl']}"
        await state.finish()
        await message.answer(text,
                             reply_markup=keyboards.mainKeyboard,
                             parse_mode=types.ParseMode.HTML,
                             disable_web_page_preview=True)


# Поиск человека
@dp.message_handler(state=DataInput.seacrhHuman)
async def human(message: types.Message, state: FSMContext):
    await message.answer("Выполняю...", reply_markup=keyboards.hideKeyboard, parse_mode=types.ParseMode.HTML)
    persons = await kinopoisk.search_person(message.text)

    if persons["result"] is None:
        await message.answer(f"{emoji.emojize(':warning:')}ERROR 404\nНикого не найдено\n Попробуйте поискать иначе",
                             reply_markup=keyboards.cancelKeyboard)
    else:
        text = ""
        text += f"Поиск - \"{persons['query']}\"    Найдено - \"{persons['numResults']}\"\n\n"
        for i in enumerate(persons["result"]):
            index = i[0] + 1
            person = i[1]
            text += f"{index}.  <a href='{person.url}'>"
            text += f"{emoji.emojize(':man_dancing:')}" if person.sex == 'M' else f"{emoji.emojize(':woman_dancing:')}"
            text += f"{person.ru_name} ({person.name})" if person.ru_name else f"{person.name}"
            text += f"</a>\n"
            text += f"{person.birthday}-"if person.birthday else ""
            text += f"{person.death}" if person.death else ""
            text += f"  ({person.age})\n" if person.age else "\n"
            text += f"<i>{person.profession}</i>\n" if person.profession else ""
            text += f"\n---\n\n"
        text += f"Все результаты поиска: {persons['resultUrl']}"
        await state.finish()
        await message.answer(text,
                             reply_markup=keyboards.mainKeyboard,
                             parse_mode=types.ParseMode.HTML,
                             disable_web_page_preview=True)


# ------------


@dp.message_handler(content_types=types.ContentType.ANY)
async def unknown_message(msg: types.Message):
    await msg.reply(f"Я не знаю, что с этим делать {emoji.emojize(':upside-down_face:')}\n"
                    f"\n"
                    f"_Список доступных команд_ \- /help", reply_markup=keyboards.mainKeyboard)


async def set_commands(bot: Bot):
    commands = [
        types.BotCommand(command="/help", description="Помощь"),
        types.BotCommand(command="/start", description="Перезапуск бота"),
        types.BotCommand(command="/film", description="Поиск фильма"),
        types.BotCommand(command="/human", description="Поиск человека"),
        types.BotCommand(command="/random", description="Случайный фильм"),
        types.BotCommand(command="/top50", description="Топ-50 лучших фильмов"),
        types.BotCommand(command="/cancel", description="Отменить текущее действие"),
        types.BotCommand(command="/menu", description="Отобразить клавиатуру"),
        types.BotCommand(command="/hide", description="Скрыть клавиатуру")
    ]
    await bot.set_my_commands(commands)


if __name__ == "__main__":
    # Запуск бота
    executor.start_polling(dp, skip_updates=True)
