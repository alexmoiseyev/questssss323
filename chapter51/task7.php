<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .address-fields {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Форма заказа устройства</h1>
    <form id="deviceForm">
        <div>
            <label for="deviceType">Тип устройства:</label>
            <select id="deviceType" name="deviceType">
                <option value="">-- Выберите тип --</option>
                <option value="cpu">Процессоры</option>
                <option value="motherboard">Материнские платы</option>
            </select>
        </div>

        <div>
            <label for="manufacturer">Производитель:</label>
            <select id="manufacturer" name="manufacturer" disabled>
                <option value="">-- Сначала выберите тип --</option>
            </select>
        </div>

        <div>
            <label>
                <input type="checkbox" id="deliveryCheckbox" name="delivery"> 
                Доставить на дом
            </label>
        </div>

        <div id="addressFields" class="address-fields">
            <div>
                <label for="region">Регион:</label>
                <input type="text" id="region" name="region">
            </div>

            <div>
                <label for="city">Город:</label>
                <input type="text" id="city" name="city">
            </div>

            <div>
                <label for="street">Улица:</label>
                <input type="text" id="street" name="street">
            </div>

            <div>
                <label for="house">Дом:</label>
                <input type="text" id="house" name="house">
            </div>

            <div>
                <label for="apartment">Квартира:</label>
                <input type="text" id="apartment" name="apartment">
            </div>
        </div>

        <button type="submit">Отправить</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deviceTypeSelect = document.getElementById('deviceType');
            const manufacturerSelect = document.getElementById('manufacturer');
            const deliveryCheckbox = document.getElementById('deliveryCheckbox');
            const addressFields = document.getElementById('addressFields');

            const manufacturers = {
                cpu: [
                    { value: 'amd', name: 'AMD' },
                    { value: 'intel', name: 'Intel' }
                ],
                motherboard: [
                    { value: 'asrock', name: 'ASRock' },
                    { value: 'msi', name: 'MSI' },
                    { value: 'gigabyte', name: 'Gigabyte' }
                ]
            };
            deviceTypeSelect.addEventListener('change', function() {
                const selectedType = this.value;
                
                manufacturerSelect.innerHTML = '';
                manufacturerSelect.disabled = !selectedType;
                
                if (selectedType) {
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = '-- Выберите производителя --';
                    manufacturerSelect.appendChild(defaultOption);
                    
                    manufacturers[selectedType].forEach(manufacturer => {
                        const option = document.createElement('option');
                        option.value = manufacturer.value;
                        option.textContent = manufacturer.name;
                        manufacturerSelect.appendChild(option);
                    });
                } else {
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = '-- Сначала выберите тип --';
                    manufacturerSelect.appendChild(defaultOption);
                }
            });

            deliveryCheckbox.addEventListener('change', function() {
                addressFields.style.display = this.checked ? 'block' : 'none';
                
                if (!this.checked) {
                    document.querySelectorAll('#addressFields input').forEach(input => {
                        input.value = '';
                    });
                }
            });
        });
    </script>
</body>
</html>