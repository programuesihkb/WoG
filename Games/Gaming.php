<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Zone</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            background-image: url("bg.jpg");
            background-size: contain;
            background-position: top;
            background-attachment: fixed;
            filter: blur(0.5);
            margin: 0;
        }
        .note {
            background-color: rgba(255, 255, 255, 0.5); 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            max-width: 300px; 
            text-align: center; 
            margin: 10px;
        }
        .game-image {
            max-width: 100%; 
            height: auto; 
            margin-bottom: 10px; 
        }
        .game-container {
            display: flex;
            flex-direction: column; 
            align-items: center; 
        }
        button {
            padding: 10px 20px;
            background-color: #007bff; 
            color: white; 
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
    <a href="../index.php"><button>Go back</button></a>
    <div class="d-flex container mt-4">
    <div class="row row-cols-2 justify-content-around">
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
    </div>

    </div>
   
    

    <?php include "../footer.php";?>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>