# Hand Rank Poker

## What is it about?
The project it about build a program that given a text file with a deck made of rows of card hands is able to rank every hand and sort it given the [Texas Hold’em card rankings](https://www.cardplayer.com/rules-of-poker/hand-rankings).


## Running the program
Open a terminal console and navigate to the root of the project.
Once there execute changing `{file_path}` for the route to your file (default is `storage/input.txt`):
```
php index.php {file_path}
```

The program will return the initial deck it got from the file and the sorted deck.

```
Initial deck
10♥ 10♦ 10♠ 9♣ 9♦ 
4♠ J♠ 8♠ 2♠ 9♠    
3♦ J♣ 8♠ 4♥ 2♠    
9♣ 9♥ 2♣ 2♦ J♣    
7♣ 7♦ 7♠ K♣ 3♦    
10♥ 10♣ 10♦ 8♥ 8♣ 
A♥ A♦ 8♣ 4♠ 7♥    
J♥ J♦ J♠ J♣ 7♦    
A♥ A♦ K♣ 4♠ 7♥    
8♣ 7♣ 6♣ 5♣ 4♣    
9♣ 8♦ 7♠ 6♦ 5♥    
4♣ 4♠ 3♣ 3♦ Q♣    
A♦ K♦ Q♦ J♦ 10♦   
                  
Sorted deck       
A♦ K♦ Q♦ J♦ 10♦
8♣ 7♣ 6♣ 5♣ 4♣
J♥ J♦ J♠ J♣ 7♦
10♥ 10♦ 10♠ 9♣ 9♦
10♥ 10♣ 10♦ 8♥ 8♣
4♠ J♠ 8♠ 2♠ 9♠
9♣ 8♦ 7♠ 6♦ 5♥
7♣ 7♦ 7♠ K♣ 3♦
9♣ 9♥ 2♣ 2♦ J♣
4♣ 4♠ 3♣ 3♦ Q♣
A♥ A♦ 8♣ 4♠ 7♥
A♥ A♦ K♣ 4♠ 7♥
3♦ J♣ 8♠ 4♥ 2♠
```

## Tests
Tests can be found on the `Tests` folder.

For running them run `./vendor/bin/phpunit Tests`
