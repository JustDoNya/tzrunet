<body>
    <div class="layer">
        <div class="mainForm" id="Form">
            <div class="filterblock">
                <div class="qualification left">
                    <div class="titleblock">
                        Образование:
                    </div>
                    <div class="selectblock">
                        <select class="select" multiple name="qualificationSelect" id="qualificationSelect">
                            <?php foreach ($array['qualification'] as $key => $value) {?>
                                <?php echo "<option selected value='$key'>$value</option>"; ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="city right">
                    <div class="titleblock">
                        Города:
                    </div>
                    <div class="selectblock">
                        <select class="select" multiple name="citySelect" id="citySelect">
                            <?php foreach ($array['city'] as $key => $value) {?>
                                <?php echo "<option selected value='$key'>$value</option>"; ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="grid">
                <div class="title">
                    Пользователи:
                </div>
                <table class="usersGrid">
                    <tr class="header">
                        <th>ФИО</th>
                        <th width="30%">Образование</th>
                        <th width="30%">Города</th>
                    </tr>
                    <?php foreach ($array['users'] as $key => $value) {
                        echo "<tr class='users' id='user$key'>";
                        foreach ($value as $key2 => $value2) {
                            if($key2 != "user_id" && $key2 != "qualification_id" && $key2 != "city") {
                                echo "<td>$value2</td>";
                            }
                        }
                        if($key2 == "city"){
                            echo "<td>";
                            $ret = '';
                            foreach ($value2 as $value3)
                                $ret .= $value3 . ",";
                            echo substr($ret, 0, -1)."</td>";
                        }
                        echo "</tr>";
                    } ?>
                </table>
            </div>
            <div class="but">
                <div class="updateGrid right" id="updateGrid">
                    <a href="javascript:;">Обновить</a>
                </div>
            </div>
        </div>
</body>
