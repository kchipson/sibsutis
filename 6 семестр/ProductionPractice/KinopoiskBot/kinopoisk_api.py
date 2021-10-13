import os
import random
import xml.etree.ElementTree as xml
import requests
import json
import re
import logging
from bs4 import BeautifulSoup
from urllib.parse import quote


class Cache:
    def __init__(self):
        self.PATH = os.path.dirname(os.path.abspath(__file__))

    def load(self) -> dict:
        try:
            with open(self.PATH + '/cache.json', 'r') as f:
                return json.loads(f.read())
        except FileNotFoundError:
            with open(self.PATH + '/cache.json', 'w') as f:
                return {}

    def write(self, cache: dict, indent: int = 4):
        with open(self.PATH + '/cache.json', 'w') as f:
            return json.dump(cache, f, indent=indent)


class Person:
    def __init__(self, data: dict):
        self._id = data['personId']
        self.name = data['nameRu'] if data['nameEn'] is None else data['nameEn']
        self.ru_name = data['nameRu']
        self.sex = data['sex']
        self.birthday = data['birthday']
        self.death = data['death']
        self.age = data['age']
        self.growth = data['growth']
        self.birthplace = data['birthplace']
        self.deathplace = data['deathplace']
        self.profession = data['profession']
        self.facts = data['facts']
        self.poster = data['posterUrl']
        self.url = data['webUrl']



class Film:
    def __init__(self, data: dict):
        self._id = data['filmId']
        self.name = data['nameRu'] if data['nameEn'] is None else data['nameEn']
        self.ru_name = data['nameRu']
        self.year = data['year']
        self.duration = data['filmLength']
        self.slogan = data['slogan']
        self.description = data['description']
        self.genres = [genre['genre'] for genre in data['genres']]
        self.countries = [country['country'] for country in data['countries']]
        self.age_rating = data['ratingAgeLimits']
        self.kp_rate = data['kp_rate']
        self.imdb_rate = data['imdb_rate']
        self.url = data['webUrl']
        self.premiere = data['premiereWorld']
        self.poster = data['posterUrl']
        self.poster_preview = data['posterUrlPreview']


class KinopoiskApi:
    def __init__(self, token, secret=None):
        self.token = token
        self.headers = {"X-API-KEY": self.token}
        self.API = 'https://kinopoiskapiunofficial.tech/api/'

    async def get_film(self, film_id):
        api_version = 'v2.1/'
        cache = Cache().load()
        rate_request = requests.get(f'https://rating.kinopoisk.ru/{film_id}.xml')
        if rate_request.status_code == 404:
            return None
        try:
            kp_rate = xml.fromstring(rate_request.text)[0].text
        except IndexError:
            kp_rate = None
        try:
            imdb_rate = xml.fromstring(rate_request.text)[1].text
        except IndexError:
            imdb_rate = None

        if str(film_id) in cache:
            data = cache[str(film_id)]
            logging.info('Фильм был в кеше')
        else:
            request = requests.get(self.API + api_version + 'films/' + str(film_id), headers=self.headers)
            if request.status_code == 404:
                return None
            data = json.loads(request.text)['data']
            logging.info('Фильма не было в кеше')

        data['kp_rate'] = kp_rate
        data['imdb_rate'] = imdb_rate
        cache[str(film_id)] = data
        Cache().write(cache)
        return Film(data)

    async def get_person(self, person_id):
        api_version = 'v1/'

        request = requests.get(self.API + api_version + 'staff/' + str(person_id), headers=self.headers)
        if request.status_code == 404:
            return None
        data = json.loads(request.text)

        return Person(data)

    async def get_random_film(self):
        chance = None
        while chance is None:
            chance = await self.get_film(random.randint(1, 1450000))
        return chance

    async def top250_films(self):
        api_version = 'v2.1/'
        request = requests.get(self.API + api_version + 'films/top?type=TOP_250_BEST_FILMS', headers=self.headers)
        if request.status_code == 404:
            return None
        pages = json.loads(request.text)["pagesCount"]
        output = []
        for i in range(pages):
            request = requests.get(self.API + api_version + f'films/top?type=TOP_250_BEST_FILMS&page={i + 1}',
                                   headers=self.headers)
            request_json = json.loads(request.text)

            for film in request_json["films"]:
                film["slogan"] = None
                film["description"] = None
                film["ratingAgeLimits"] = None
                film["kp_rate"] = film["rating"]
                film["imdb_rate"] = None
                film["webUrl"] = f"http://www.kinopoisk.ru/film/{film['filmId']}"
                film["premiereWorld"] = None
                output.append(Film(film))
        return output

    async def search_person(self, query):
            url = f"https://www.kinopoisk.ru/s/type/people/list/1/find/{quote(query)}/order/relevant/"

            request = requests.get(url)
            soup = BeautifulSoup(request.text, 'html.parser')

            # search_results = soup.find('span', attrs={'class': re.compile('search_results_topText')}).text.split()
            # query = search_results[1]
            # num_results = search_results[-1]
            search_results = soup.find('span', attrs={'class': re.compile('search_results_topText')})
            query = search_results.b.text
            num_results = search_results.text.split()[-1]
            if num_results == '0':
                return {'query': query, 'numResults': num_results, 'result': None, 'resultUrl': url}

            results = soup.findAll('div', attrs={'class': re.compile('element')})
            results10 = results[:10]
            result = []
            for i in results10:
                 result.append(await self.get_person(i.p.a["data-id"]))

            return {'query': query, 'numResults': num_results, 'result': result, 'resultUrl': url}

    async def search_film(self, query):
            url = f"https://www.kinopoisk.ru/s/type/film/list/1/find/{quote(query)}/order/relevant/"

            request = requests.get(url)
            soup = BeautifulSoup(request.text, 'html.parser')

            # search_results = soup.find('span', attrs={'class': re.compile('search_results_topText')}).text.split()
            # query = search_results[1]
            # num_results = search_results[-1]
            search_results = soup.find('span', attrs={'class': re.compile('search_results_topText')})
            query = search_results.b.text
            num_results = search_results.text.split()[-1]
            if num_results == '0':
                return {'query': query, 'numResults': num_results, 'result': None, 'resultUrl': url}

            results = soup.findAll('div', attrs={'class': re.compile('element')})
            results10 = results[:10]
            result = []
            for i in results10:
                result.append(await self.get_film(i.p.a["data-id"]))

            return {'query': query, 'numResults': num_results, 'result': result, 'resultUrl': url}