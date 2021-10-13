from aiogram.types import ReplyKeyboardRemove, ReplyKeyboardMarkup, KeyboardButton, InlineKeyboardMarkup, \
    InlineKeyboardButton
import emoji


class MainKey:
    searchFilm = f"{emoji.emojize(':clapper_board:')} Поиск фильма/сериала"
    searchActor = f"{emoji.emojize(':woman_dancing:')} Поиск человека"
    randomFilm = f"{emoji.emojize(':game_die:')} Cлучайный фильм/сериал"
    top500Film = f"{emoji.emojize(':TOP_arrow:')} Топ 50 фильмов"


mainKeyboard = ReplyKeyboardMarkup(resize_keyboard=True)
mainKeyboard.add(*[MainKey.searchFilm, MainKey.searchActor])
mainKeyboard.add(*[MainKey.randomFilm, MainKey.top500Film])


# ------------


cancelKey = f"{emoji.emojize(':stop_sign:')} Отменить действие"
cancelKeyboard = ReplyKeyboardMarkup(resize_keyboard=True)
cancelKeyboard.add(cancelKey)

cancelKeyboardInline = InlineKeyboardMarkup()
cancelKeyboardInline.add(InlineKeyboardButton(text=cancelKey, callback_data="cancel_button"))


# ------------


hideKeyboard = ReplyKeyboardRemove()
