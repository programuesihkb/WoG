<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-image: url("bg.jpg");
            background-size: contain;
            background-position: top;
            background-attachment: fixed;
            filter: blur(0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .note {
            background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow effect */
            max-width: 300px; /* Limit the maximum width of the note */
            text-align: center; /* Center align the content */
        }
        .game-image {
            max-width: 100%; /* Ensure the image doesn't exceed its container */
            height: auto; /* Maintain aspect ratio */
            margin-bottom: 10px; /* Add space between the image and button */
        }
        .game-container {
            display: flex;
            flex-direction: column; /* Arrange items vertically */
            align-items: center; /* Center align items horizontally */
        }
    </style>
</head>
<body>
    
    <div class="note">
        <div class="game-container">
            <img src="gamingImages/hangman.jpg" alt="Hangman Game" class="game-image">
            <a href="hangman.html"><button>Play Hangman</button></a>
        </div>
        <p>Welcome to Hangman! Test your vocabulary and guessing skills by trying to guess the hidden word. Each incorrect guess brings you one step closer to being hanged, so choose your letters wisely! Have fun and see if you can save the poor stick figure from its fate.</p>
    </div>
    <div class="note">
        <div class="game-container">
            <img src="gamingImages/tictac.png" alt="Hangman Game" class="game-image">
            <a href="ticTacToe.html"><button>Play TicTacToe</button></a>
        </div>
        <p>Get ready for some classic fun with Tic-Tac-Toe! Challenge your strategy against the computer. Take turns placing your 'X' or 'O' on the grid, aiming to get three in a row horizontally, vertically, or diagonally.Can you outsmart your opponent and claim victory?</p>
    </div>
    <div class="note">
        <div class="game-container">
            <img src="gamingImages/memory.jpg" alt="Hangman Game" class="game-image">
            <a href="memoryCards.html"><button>Play Memory Cards</button></a>
        </div>
        <p>Boost your memory and focus with our Memory Card game! Match pairs of cards before time runs out. It's a fun way to train your brain and improve your recall abilities. Play now and see how sharp your memory really is!</p>
    </div>
    <div class="note">
        <div class="game-container">
            <img src="gamingImages/number.png" alt="Hangman Game" class="game-image">
            <a href="numberGuessing.html"><button>Play Number Guessing</button></a>
        </div>
        <p>Test your intuition and number skills with our Number Guessing game! Guess the correct number within the given range and beat your own record. It's a simple yet addictive game that's perfect for passing the time and challenging your friends. Start guessing now and see if you can crack the code!</p>
    </div>
    <div class="note">
        <div class="game-container">
            <img src="gamingImages/r.png" alt="Hangman Game" class="game-image">
            <a href="rockPaperScissors.html"><button>Play Rock Paper Scissors</button></a>
        </div>
        <p>Rock, Paper, Scissors: the timeless game of strategy and luck! Challenge your friends or test your wits against the computer in this classic showdown. Will you choose rock, paper, or scissors? With simple rules and endless fun, it's the perfect way to settle any dispute or simply have a good time. Let the games begin!</p>
    </div>
    <a href="../index.php"><button>Go back</button></a>
</body>
</html>