<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница личного кабинета</title>

    <style>
        body {
            background-color: beige;
            font-size: 1.5rem;
        }
        input {
            font-size: 1.5rem;
            padding: 0.5rem;
        }
        .container {
            margin: auto;
            margin-top: 5rem;
            max-width: 1400px;
            padding: 3rem;
            border: 0.1em dotted orangered;
        }
        h1 {
            text-align: center;
        }
        p>span:nth-child(1) {
            font-weight: bold;
            color: blue;
        }
        p>span:nth-child(2) {
            font-style: italic;
        }
        .edit-btn {
            padding: 0.5rem;
            margin-left: 1rem;
            background-color: green;
            cursor: pointer;
            border: 0;
            border-radius: 8px;
            color: white;
        }
        .edit-btn:hover {
            background-color: darkgreen;
        }
        .cancel-btn {
            padding: 0.5rem;
            margin-left: 1rem;
            background-color: gray;
            cursor: pointer;
            border: 0;
            border-radius: 8px;
            color: white;
        }
        .cancel-btn:hover {
            background-color: darkgray;
        }
        .save-btn {
            padding: 0.5rem;
            margin-left: 1rem;
            background-color: orange;
            cursor: pointer;
            border: 0;
            border-radius: 8px;
            color: white;
        }
        .save-btn:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Личный кабинет пользователя</h1>
        <p>
            <span>Id: </span>
            <span><?php echo $_SESSION["id"]; ?></span>
        </p>
        <p>
            <span>Имя: </span>
            <span><?php echo $_SESSION["name"]; ?></span>
            <span class="edit-btn">Изменить</span>
            <span class="save-btn" hidden data-item="name">Сохранить</span>
            <span class="cancel-btn" hidden>Отменить</span>
        </p>
        <p>
            <span>Фамилия: </span>
            <span><?php echo $_SESSION["lastname"]; ?></span>
            <span class="edit-btn">Изменить</span>
            <span class="save-btn" hidden data-item="lastname">Сохранить</span>
            <span class="cancel-btn" hidden>Отменить</span>
        </p>
        <p>
            <span>Email: </span>
            <span><?php echo $_SESSION["email"]; ?></span>
        </p>
    </div>
    

    <script>
        let edit_buttons = document.querySelectorAll(".edit-btn");
        let save_buttons = document.querySelectorAll(".save-btn");
        let cancel_buttons = document.querySelectorAll(".cancel-btn");
        
        for (let i = 0; i < edit_buttons.length; i++) {
            let inputValue = edit_buttons[i].previousElementSibling.innerText;

            edit_buttons[i].addEventListener("click", () => {
                edit_buttons[i].previousElementSibling.innerHTML = `<input type="text" value="${inputValue}">`;
                edit_buttons[i].hidden = true;
                save_buttons[i].hidden = false;
                cancel_buttons[i].hidden = false;

            })

            cancel_buttons[i].addEventListener("click", () => {
                edit_buttons[i].previousElementSibling.innerText = inputValue;
                edit_buttons[i].hidden = false;
                save_buttons[i].hidden = true;
                cancel_buttons[i].hidden = true;
            })

            save_buttons[i].addEventListener("click", async () => {
                let newInputValue = edit_buttons[i].previousElementSibling.firstElementChild.value;

                edit_buttons[i].previousElementSibling.innerText = newInputValue;
                edit_buttons[i].hidden = false;
                save_buttons[i].hidden = true;
                cancel_buttons[i].hidden = true;

                let formData = new FormData();
                formData.append("value", newInputValue);
                formData.append("item", save_buttons[i].dataset.item)

                let response = await fetch("php/lk_obr.php", {
                    method: "POST",
                    body: formData
                });
            })
        }
    </script>
</body>
</html>