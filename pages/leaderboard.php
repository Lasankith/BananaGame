<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "bananadb");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch leaderboard data for EASY, MEDIUM, and HARD levels
$easySql = "SELECT userName, score FROM leaderboard ORDER BY score DESC LIMIT 10"; // EASY tab
$mediumSql = "SELECT userName, score FROM mediumleaderboard ORDER BY score DESC LIMIT 10"; // MEDIUM tab
$hardSql = "SELECT userName, score FROM leaderhard ORDER BY score DESC LIMIT 10"; // HARD tab

$easyResult = mysqli_query($con, $easySql);
$mediumResult = mysqli_query($con, $mediumSql);
$hardResult = mysqli_query($con, $hardSql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bananaGame.css">
    <title>The Banana Game</title>
    <style>
        th, td {
            border-radius: 20px;
        }

        .icons {
            margin-top: 10px;
            position: absolute;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            width: 800px;
        }

        .small-img {
            display: block;
            margin: 0px 450px;
            width: 50px;
            height: auto;
        }

        .small-img:hover {
            transform: scale(1.2);
            box-shadow: 0px 4px 15px rgba(255, 255, 255, 0);
        }

        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color:#F1F383;
            margin-top: 50px;
        }

        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        .tab button:hover {
            background-color:#DEAE57;
        }

        .tab button.active {
            background-color:#D5B677;
        }

        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
			color: black;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 0px solid #ddd;
        }
        th {
            background-color:#E9CD71;
        }

        .scrollable-table {
            max-height: 400px;
            overflow-y: auto;
            margin-top: 10px;
        }

        .rank-icon {
            width: 35px;
            height: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <p><img src='../images/lead.png' alt='1st' width="250px;" height="60px;"></p>
        <div class="game-info" align="center">
            <div style="width: 60%; border: 0px;">
              <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'Instructions')" id="defaultOpen">EASY</button>
                    <button class="tablinks" onclick="openTab(event, 'Leaderboard')">MEDIUM</button>
                    <button class="tablinks" onclick="openTab(event, 'About')">HARD</button>
              </div>

                <!-- EASY -->
                <div id="Instructions" class="tabcontent" style="border: 0px;">
                    <div class="scrollable-table">
                        <table>
                            <tr>
                                <th>Rank</th>
                                <th>Username</th>
                                <th>Score</th>
                            </tr>
                            <?php
                            if (mysqli_num_rows($easyResult) > 0) {
                                $rank = 1;
                                while ($row = mysqli_fetch_assoc($easyResult)) {
                                    echo "<tr>";
                                    // Add rank icons for top 3
                                    if ($rank == 1) {
                                        echo "<td><img src='../images/1.png' alt='1st' class='rank-icon'></td>";
                                    } elseif ($rank == 2) {
                                        echo "<td><img src='../images/8.png' alt='2nd' class='rank-icon'></td>";
                                    } elseif ($rank == 3) {
                                        echo "<td><img src='../images/2.png' alt='3rd' class='rank-icon'></td>";
                                    } else {
                                        echo "<td>$rank</td>";
                                    }
                                    echo "<td>" . $row['userName'] . "</td><td>" . $row['score'] . "</td>";
                                    echo "</tr>";
                                    $rank++;
                                }
                            } else {
                                echo "<tr><td colspan='3'>No leaderboard data available</td></tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>

                <!-- MEDIUM -->
                <div id="Leaderboard" class="tabcontent" style="border: 0px;">
                    <div class="scrollable-table">
                        <table>
                            <tr>
                                <th>Rank</th>
                                <th>Username</th>
                                <th>Score</th>
                            </tr>
                            <?php
                            if (mysqli_num_rows($mediumResult) > 0) {
                                $rank = 1;
                                while ($row = mysqli_fetch_assoc($mediumResult)) {
                                    echo "<tr>";
                                    if ($rank == 1) {
                                        echo "<td><img src='../images/1.png' alt='1st' class='rank-icon'></td>";
                                    } elseif ($rank == 2) {
                                        echo "<td><img src='../images/8.png' alt='2nd' class='rank-icon'></td>";
                                    } elseif ($rank == 3) {
                                        echo "<td><img src='../images/2.png' alt='3rd' class='rank-icon'></td>";
                                    } else {
                                        echo "<td>$rank</td>";
                                    }
                                    echo "<td>" . $row['userName'] . "</td><td>" . $row['score'] . "</td>";
                                    echo "</tr>";
                                    $rank++;
                                }
                            } else {
                                echo "<tr><td colspan='3'>No leaderboard data available</td></tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>

                <!-- HARD -->
                <div id="About" class="tabcontent" style="border: 0px;">
                    <div class="scrollable-table">
                        <table>
                            <tr>
                                <th>Rank</th>
                                <th>Username</th>
                                <th>Score</th>
                            </tr>
                            <?php
                            if (mysqli_num_rows($hardResult) > 0) {
                                $rank = 1;
                                while ($row = mysqli_fetch_assoc($hardResult)) {
                                    echo "<tr>";
                                    if ($rank == 1) {
                                        echo "<td><img src='../images/1.png' alt='1st' class='rank-icon'></td>";
                                    } elseif ($rank == 2) {
                                        echo "<td><img src='../images/8.png' alt='2nd' class='rank-icon'></td>";
                                    } elseif ($rank == 3) {
                                        echo "<td><img src='../images/2.png' alt='3rd' class='rank-icon'></td>";
                                    } else {
                                        echo "<td>$rank</td>";
                                    }
                                    echo "<td>" . $row['userName'] . "</td><td>" . $row['score'] . "</td>";
                                    echo "</tr>";
                                    $rank++;
                                }
                            } else {
                                echo "<tr><td colspan='3'>No leaderboard data available</td></tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
          </div>
        </div>

        <a href="menu.php"><img src="../images/quit.png" alt="Leaderboard" class="small-img" id="button6"></a>
    </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        document.getElementById("defaultOpen").click();
    </script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($con);
?>


