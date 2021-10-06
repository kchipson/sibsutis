 #include "Structure.h"
#include <string>
using namespace std;

phone_book* generateStructure()
{
    phone_book* records;
    records = new phone_book[structSize];

    records[0] = {
        "Макаров",
        "Дмиртий",
        "+7(912)343-36-64",
        "makarov.dm@mail.ru"
    }; 

    records[1] = {
        "Злобин",
        "Алексей",
        "+7(992)806-24-36",
        "zlobin.aleksey@gmail.com"
    };

    records[2] = {
        "Домашенко",
        "Никита",
        "+79257053307",
        "nikita.domashenko@mail.ru"
    };

    records[3] = {
        "Лацигин",
        "Максим",
        "+7(911)713-65-33",
        "maksim.latsigin.star@gmail.com"
    };

    records[4] = {
        "Байц",
        "Антон",
        "+7(917)440-19-53",
        "ant.bayts@ya.com"
    };

    records[5] = {
        "Горбунова",
        "Екатерина",
        "+7(913)305-05-46",
        "gorbunova.yek@yandex.ru"
    };

    records[6] = {
        "Овченков",
        "Евгений",
        "+7(978)459-71-51",
        "yevgeny05@gmail.com"
    };

    records[7] = {
        "Щеголев",
        "Алексей",
        "+7(943)297-31-78",
        "shchegolev00@mail.ru"
    };

    records[8] = {
        "Адов",
        "Артём",
        "+7(909)730-33-67",
        "boss.artem43@bk.ru"
    };

    records[9] = {
        "Андросов",
        "Сергей",
        "+7(995)830-81-23",
        "serenya.androsov007@list.ru"
    };

    records[10] = {
        "Пимонова",
        "Юлия",
        "+7(988)617-34-81",
        "julia00.omn1kova@index.ru"
    };

    records[11] = {
        "Волошин",
        "Дмитрий",
        "+7(921)205-33-99",
        "dmitry.voloshin@gmail.com"
    };

    records[12] = {
        "Пальмов",
        "Никита",
        "+7(909)583-67-48",
        "nikitapalmov28@gmail.com"
    };

    records[13] = {
        "Захарченко",
        "Александр",
        "+7(987)958-69-35",
        "zaharchenkoalexandr@lenta.ru"
    };

    records[14] = {
        "Кимлаев",
        "Иван",
        "+7(968)198-72-17",
        "vanik5451@gmail.com"
    };

    return records;
}