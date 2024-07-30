<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament Bracket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tournament-bracket.css') }}">
    <style>
        label, form input[type=text], input[type=submit], textarea {
            float: left;
            clear: both;
        }
        textarea {
            height: 250px;
            font-family: Arial, sans-serif;
        }
        input[type=submit] {
            background-color: #a2c257;
            border-color: #8ba446;
            color: white;
            cursor: pointer;
            margin: 0;
            width: 500px;
        }
        input:focus, textarea:focus {
            border-color: black;
        }
        .radio-label {
            margin-bottom: 20px;
        }
        #or {
            float: left;
            clear: both;
            width: 100%;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }
        #brackets-wrapper, #round-titles-wrapper {
            position: relative;
            margin-top: 20px;
            float: left;
        }
        #brackets-wrapper {
            top: 70px;
        }
        .round-title {
            height: 30px;
            text-align: center;
            line-height: 30px;
        }
        .round-title, .match-wrapper {
            border: 1px solid #cdc9c9;
            box-sizing: border-box;
            position: absolute;
            width: 150px;
            background-color: #f5f5f5;
        }
        .match-divider {
            width: 100%;
            float: left;
            border-top: 1px solid #cdc9c9;
        }
        .horizontal-connector, .vertical-connector {
            position: absolute;
        }
        .vertical-connector {
            border-left: 3px solid #cdc9c9;
            width: 3px;
        }
        .horizontal-connector {
            border-top: 3px solid #cdc9c9;
            width: 20px;
        }
        .player-wrapper {
            background-color: #f5f5f5;
            box-sizing: border-box;
            padding-left: 5px;
            width: 80%;
        }
        .score {
            background-color: #f0f0f0;
            box-sizing: border-box;
            text-align: center;
            width: 20%;
            border: 0;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }
        .player-wrapper, .score {
            float: right!important;
            height: 30px;
            line-height: 30px;
            overflow: hidden;
        }
        #version {
            color: #404040;
            width: 488px;
            text-align: center;
            margin-left: 20px;
        }
        .singleElimination_select {
            border: 0 none;
            height: 30px;
            width: 80%;
            background-color: #f5f5f5;
            -webkit-appearance: none;
            -moz-appearance: none;
            text-indent: 1px;
            text-overflow: '';
            font-size: 16px;
            font-family: Arial, sans-serif;
        }
        .preliminary_select {
            border: 1px solid #cdc9c9;
            height: 30px;
            width: 100%;
            background-color: #f5f5f5;
            -webkit-appearance: none;
            -moz-appearance: none;
            text-indent: 1px;
            text-overflow: '';
            font-size: 16px;
            font-family: Arial, sans-serif;
        }
        select::-ms-expand {
            display: none;
        }
        @media print {
            form, h1, #version {
                display: none;
            }
            .round-title, .match-wrapper, .player-wrapper {
                border-color: black;
            }
            .match-divider, .vertical-connector, .horizontal-connector, select {
                border-color: black;
            }
        }
        #success {
            background-color: #DFF2BF;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tournament Bracket - Dummy Tournament</h1>
        <div id="round-titles-wrapper">
            <div class="round-title">Round 1</div>
            <div class="round-title" style="left: 200px;">Semifinals</div>
            <div class="round-title" style="left: 400px;">Final</div>
        </div>
        <div id="brackets-wrapper">
            <!-- Round 1 -->
            <div class="round">
                <div class="match-wrapper" style="top: 0;">
                    <div class="player-wrapper">Team A</div>
                    <div class="player-wrapper">Team B</div>
                    <div class="score">Score</div>
                </div>
                <div class="match-wrapper" style="top: 60px; left: 200px;">
                    <div class="player-wrapper">Team C</div>
                    <div class="player-wrapper">Team D</div>
                    <div class="score">Score</div>
                </div>
                <div class="match-wrapper" style="top: 120px; left: 400px;">
                    <div class="player-wrapper">Team E</div>
                    <div class="player-wrapper">Team F</div>
                    <div class="score">Score</div>
                </div>
                <div class="match-wrapper" style="top: 180px; left: 600px;">
                    <div class="player-wrapper">Team G</div>
                    <div class="player-wrapper">Team H</div>
                    <div class="score">Score</div>
                </div>
            </div>
            <!-- Semifinals -->
            <div class="round">
                <div class="match-wrapper" style="top: 0; left: 200px;">
                    <div class="player-wrapper">Winner A/B</div>
                    <div class="player-wrapper">Winner C/D</div>
                    <div class="score">Score</div>
                    <div class="horizontal-connector" style="top: 30px; left: -40px;"></div>
                    <div class="vertical-connector" style="top: 30px; left: 0;"></div>
                </div>
                <div class="match-wrapper" style="top: 60px; left: 400px;">
                    <div class="player-wrapper">Winner E/F</div>
                    <div class="player-wrapper">Winner G/H</div>
                    <div class="score">Score</div>
                    <div class="horizontal-connector" style="top: 30px; left: -40px;"></div>
                    <div class="vertical-connector" style="top: 30px; left: 0;"></div>
                </div>
            </div>
            <!-- Final -->
            <div class="round">
                <div class="match-wrapper" style="top: 0; left: 400px;">
                    <div class="player-wrapper">Winner SF1</div>
                    <div class="player-wrapper">Winner SF2</div>
                    <div class="score">Score</div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 