from lib import *
from itertools import product

import os
import sys

def main():
    nominals = ('2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'T')
    suits = ('♥','♠', '♣', '♦')
    
    deck = list(n + s for n,s in product(nominals, suits))
    random.shuffle(deck)
    assert (len(deck) - 5) >=2
    
    deck_dict = {i: card for i, card in enumerate(deck, start=2)}
    deck_keys = deck_dict.keys()
    
    num_players = 5
    assert 0 < num_players < (len(deck) - 5) // 2
    
    p = gen_safe_prime(1 << 10, 1 << 20)
    
    print('\n', f"{p = }", '\n')
    
    #Шифрование колоды
    print("Шифрование:")
    players_decryption_keys = []
    for i in range(num_players):
        print(f"{i + 1}-й игрок:")
        c = gen_mutually_prime(p - 1)
        d = inverse(c, p - 1)
        print('\t', f"{c = }", '\n', '\t', f"{d = }")
        deck_keys = list(exponentiation_modulo(card, c, p) for card in deck_keys)
        random.shuffle(deck_keys)
        print(deck_keys)
        players_decryption_keys.append(d)
        print()
    
   
    
    table_cards = deck_keys[-5:]
    print("Зашифрованные карты на столе:",  table_cards, sep='\n')
    players_cards = [[deck_keys[i], deck_keys[i + 1]] for i in range(0, num_players * 2, 2)]
    print("Зашифрованные карты игроков:",  players_cards, sep='\n')
    
    print("Дешифрование:")
    for key in players_decryption_keys:
            table_cards = [exponentiation_modulo(card, key, p) for card in table_cards]
            print(table_cards)
    for i in range(num_players):
        #Собственный ключ игрок использует в последнюю очередь (инвалидный способ)
        players_decryption_keys = players_decryption_keys[1:] + players_decryption_keys[:1]
        for key in players_decryption_keys:
            players_cards[i] = [exponentiation_modulo(card, key, p) for card in players_cards[i]]
            print(players_cards)
     
    table_cards = list(deck_dict[key] for key in table_cards)
    players_cards = list(list(deck_dict[key] for key in player) for player in players_cards)
    print('-'*10, "Карты на столе:",  table_cards, "Карты игроков:",  players_cards, sep='\n')
def test():
    a = list(range(5))
    print(a, a[-2:])


if __name__ == "__main__":
    main()
    # test()
