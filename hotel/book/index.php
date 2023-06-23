<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <title>Бронирование гостиницы</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    <?php include '../header.php' ?>

    <h1>Бронирование</h1>

    <form method="POST" action="process_booking.php">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required >

        <label for="phone">Номер телефона:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="check_in_date">Дата заезда:</label>
        <input type="text" id="check_in_date" name="check_in_date" class="datepicker" required >

        <label for="check_out_date">Дата отъезда:</label>
        <input type="text" id="check_out_date" name="check_out_date" class="datepicker" required min="" readonly>

        <label for="room">Комната</label>
        <select name="room" id="room">
            <option value="Стандарт">Стандарт</option>
            <option value="Комфорт">Комфорт</option>
        </select>

        <button type="submit" >Забронировать</button>
    </form>

    <?php 
    include '../footer.php'
    ?>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/inputmask/dist/jquery.inputmask.bundle.min.js"></script>
    
    <script>
   flatpickr('.datepicker', {
    dateFormat: 'Y-m-d',
    minDate: 'today', // Запрет выбора прошедших дат
    onChange: function(selectedDates, dateStr, instance) {
        // Получение элементов полей дат заезда и отъезда
        var checkInDateInput = document.getElementById("check_in_date");
        var checkOutDateInput = document.getElementById("check_out_date");

        // Обновление минимальной даты для выбора даты отъезда
        if (instance.input === checkInDateInput) {
            var minCheckOutDate = selectedDates[0];
            minCheckOutDate.setDate(minCheckOutDate.getDate() + 1); // Увеличение на 1 день
            checkOutDateInput._flatpickr.set("minDate", minCheckOutDate);
        }

        // Проверка выбранной даты отъезда
        var selectedCheckOutDate = checkOutDateInput._flatpickr.selectedDates[0];
        if (selectedCheckOutDate && selectedCheckOutDate < checkOutDateInput._flatpickr.config.minDate) {
            checkOutDateInput._flatpickr.clear();
        }
    }
});



        $(document).ready(function () {
            // Настройка маски для поля номера телефона
            $('#phone').inputmask('+7-999-999-99-99');
        });
    </script>
   
</body>
</html>
