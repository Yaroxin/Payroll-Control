$( "#bonusBlock" ).click(function() { 
    let bonusBlockHidden = document.getElementById('bonusBlockHidden');

    if (this.checked == true){
        bonusBlockHidden.value = "1";        
    }

    if (this.checked == false){
        bonusBlockHidden.value = "0";
    }
});

$( "#productBlock" ).click(function() { 
    let productBlockHidden = document.getElementById('productBlockHidden');

    if (this.checked == true){
        productBlockHidden.value = "1";        
    }

    if (this.checked == false){
        productBlockHidden.value = "0";
    }
});

$(document).ready(function () {    
    $('.WorkDayListItem').focus(function () {
        if (this.value < '0,01') {
            this.value = '';
        }
    });
    $('.WorkDayListItem').blur(function () {
        if (this.value < '0,01') {
            this.value = '0';
        }
    });
});

function addWorkDay(formId) {
    $(formId).submit(function (e) {
        e.preventDefault();
        let parent = document.querySelector(formId);
        let child = parent.querySelector('.InputDate');
        let date = new Date(child.value);

        $.ajax({
            url: "addWorkDay.php",
            type: "POST",
            data: $(formId).serialize(),
            success: function (response) {
                result = jQuery.parseJSON(response);
                if(result == "Запись добавлена!"){
                    alert(result);
                    window.location = "/single.php?day=" + date.getDate() + "&month=" + (date.getMonth() + 1) + "&year=" + date.getFullYear();
                }else{
                    alert(result);
                }                
            },
            error: function (response) {
                alert('Ошибка');
            },
        });
    })
}


function showMoreItemInfo(id) {
    let moreItemInfoId = document.getElementById('moreItemInfo' + id);
    moreItemInfoId.classList.toggle('hide');
}

function activateAddButton(type) {
    let Hours = document.getElementById(type + 'Hours');
    let addButton = document.getElementById('Add' + type + 'Day');
    let hourlyPayCheck = (document.getElementById('hourlyPayCheck')).checked;
    let hourlyPayValue = document.getElementById('hourlyPayValue');

    if(hourlyPayCheck == true){
        summ = hourlyPayValue.value * Hours.value ;
    }else{
        if(type == "bending"){
            let item1count = document.getElementById('item1count');
            let item2count = document.getElementById('item2count');
            let item3count = document.getElementById('item3count');
            let item4count = document.getElementById('item4count');
            let item5count = document.getElementById('item5count');
            summ = Number(item1count.value) + Number(item2count.value) + Number(item3count.value) + Number(item4count.value) + Number(item5count.value);
        }
    }     
    
    if(Hours.value > 0 & summ > 0){        
        addButton.classList.remove('notActiveBtn');
        addButton.disabled = false;
    }

    if(Hours.value <= 0 || summ <= 0){
        addButton.classList.add("notActiveBtn");
        addButton.disabled = true;
    }
}

function summCalc(type) {

    if(type == 'bending'){
        let hourlyPayCheck = (document.getElementById('hourlyPayCheck')).checked;
        let extraShiftCheck = (document.getElementById('extraShiftCheck')).checked;
        let paySummBending = document.getElementById('paySummBending');
        let extraShiftValue = Number(document.getElementById('extraShiftValue').value);
        let summ = 0;
        
        if(hourlyPayCheck == true){

            let hours = (document.getElementById('bendingHours')).value;
            let hourlyPayValue = (document.getElementById('hourlyPayValue')).value;
            let Fine = Number((document.getElementById('fine')).value);
            let Bonus = Number((document.getElementById('Rub').value));
            summ = ((hours * hourlyPayValue) + Bonus) - Fine;

        }else{            
            let item1count = Number((document.getElementById('item1count')).value);
            let item2count = Number((document.getElementById('item2count')).value);
            let item3count = Number((document.getElementById('item3count')).value);
            let item4count = Number((document.getElementById('item4count')).value);
            let item5count = Number((document.getElementById('item5count')).value);
            let item1cost = Number((document.getElementById('item1cost')).value);
            let item2cost = Number((document.getElementById('item2cost')).value);
            let item3cost = Number((document.getElementById('item3cost')).value);
            let item4cost = Number((document.getElementById('item4cost')).value);
            let item5cost = Number((document.getElementById('item5cost')).value);

            let fine = Number((document.getElementById('fine')).value);
            let Rub = Number((document.getElementById('Rub').value));

            summ = (((item1count * item1cost) + (item2count * item2cost) + (item3count * item3cost) + (item4count * item4cost) + (item5count * item5cost)) - fine) + Rub;
            
        }

        if(extraShiftCheck == true){
            summ = summ + extraShiftValue;
        }
        paySummBending.value = "Итого: " + summ.toFixed(0) + " ₽";
    }
}


function editValues(tableId) {
    let table = document.getElementById(tableId);    
    let inputs = table.getElementsByTagName('input');
    
    for (let input of inputs) {
        input.disabled = false;
    }

    if(tableId == 'addBendingTable'){
        let editBendingDay = document.getElementById('editBendingDay');
        let saveBendingValues = document.getElementById('saveBendingValues'); 
        let changeDateTr = document.getElementById('changeDateTr');
        editBendingDay.disabled = true;
        editBendingDay.classList.add("notActiveBtn");
        saveBendingValues.disabled = false;
        saveBendingValues.classList.remove("notActiveBtn");
        changeDateTr.classList.toggle('hide');
    }

    if(tableId == 'addHourlyTable'){
        let editHourlyDay = document.getElementById('editHourlyDay');
        let saveHourlyValues = document.getElementById('saveHourlyValues'); 
        editHourlyDay.disabled = true;
        editHourlyDay.classList.add("notActiveBtn");
        saveHourlyValues.disabled = false;
        saveHourlyValues.classList.remove("notActiveBtn");
    }

}

function saveValues(formId, tableId) {
    $(formId).submit(function (e) {
        e.preventDefault();        
        
        $.ajax({
            url: "saveValues.php",
            type: "POST",
            data: $(formId).serialize(),
            success: function (response) {
                result = jQuery.parseJSON(response);
                alert(result);
                document.location.reload();
                // document.location = '/';            
            },
            error: function (response) {
                alert('Ошибка');
            },
        });
    });    
}

function showUserArea() {
    let mainWindow = document.getElementById('mainWindow');
    let userNameModal = document.getElementById('userNameModal');

    mainWindow.classList.toggle('hide');
    userNameModal.classList.toggle('hide');
}

function getMonthNum(monthStr){
    return new Date(monthStr+'-1-01').getMonth()+1
}

function changeMonth(month) {
    let monthName = month.split(" ")[0];
    let yearNum = month.split(" ")[1];

    if (history.pushState) {
        let baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        let newUrl = baseUrl + '?month=' + getMonthNum(monthName) + '&year=' + yearNum;
        history.pushState(null, null, newUrl);
        location.reload();
    }else {
        console.warn('History API не поддерживается');
    }
}

function changeSettings(setValue) {    
    setValue.value = setValue.checked;
    let modul = document.getElementById(setValue.name);
    modul.value = setValue.checked;

    let moduleContent = document.getElementById(setValue.name + 'Block');
    moduleContent.classList.toggle('hide');   
}

$( "#saveSettings" ).click(function() {    
    $('#settingsForm').submit(function (e) {
        e.preventDefault();               
        $.ajax({
            url: "saveSettings.php",
            type: "POST",
            data: $('#settingsForm').serialize(),
            success: function (response) {
                result = jQuery.parseJSON(response);
                if(result == "Success"){
                    document.location.reload();
                }else{
                    alert(result);
                }                
            },
            error: function (response) {
                alert('Ошибка');
            },
        });
    });
});

function showModuleSet(moduleName) {
    let content = document.getElementById(moduleName + 'Content');
    let show = document.getElementById(moduleName + 'Show');

    content.classList.toggle('hide');

    if(show.innerText == 'Развернуть'){
        show.innerText = 'Свернуть';
    }else{
        show.innerText = 'Развернуть';
    }    
}

$( "#addPayout" ).click(function() {
    let payoutInfo = document.getElementById('payoutInfo');
    let addPayoutBlock = document.getElementById('addPayoutBlock');
    let changePayout = document.getElementById('changePayout');
    let clearPayout = document.getElementById('clearPayout');
    let type = document.getElementById('type');

    payoutInfo.classList.toggle('hide');
    addPayoutBlock.classList.toggle('hide');

    type.value = 'addPayout';

    if(this.innerText == 'Добавить'){
        this.innerText = 'Отменить';
        changePayout.classList.add('hide');
        clearPayout.classList.add('hide');
    }else{
        if(this.innerText == 'Отменить'){
            this.innerText = 'Добавить';
            changePayout.classList.remove('hide');
            clearPayout.classList.remove('hide');
        }  
    }
});

$( "#changePayout" ).click(function() {
    let payoutInfo = document.getElementById('payoutInfo');
    let addPayoutBlock = document.getElementById('addPayoutBlock');
    let addPayout = document.getElementById('addPayout');
    let clearPayout = document.getElementById('clearPayout');
    let type = document.getElementById('type');

    payoutInfo.classList.toggle('hide');
    addPayoutBlock.classList.toggle('hide');

    type.value = 'changePayout';

    if(this.innerText == 'Изменить'){
        this.innerText = 'Отменить';
        addPayout.classList.add('hide');
        clearPayout.classList.add('hide');
    }else{
        if(this.innerText == 'Отменить'){
            this.innerText = 'Изменить';
            addPayout.classList.remove('hide');
            clearPayout.classList.remove('hide');
        }        
    }
});

$( "#clearPayout" ).click(function() {
    if(confirm("Очистить?")){
        let selectMonth = document.getElementById('selectMonth');
        $.ajax({
            url: "addPayout.php",
            type: "POST",
            data:{
                type: 'clearPayout',
                date: selectMonth.value,
            },                
            success: function (response) {
                result = jQuery.parseJSON(response);
                if(result != 'OK'){
                    alert(result);
                }else{
                    document.location.reload();
                }                
            },
            error: function (response) {
                alert('Ошибка');
            },
        });
    }
});

$( "#savePayout" ).click(function() {
    $('#addPayoutForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "addPayout.php",
            type: "POST",
            data: $('#addPayoutForm').serialize(),
            success: function (response) {
                result = jQuery.parseJSON(response);
                if(result != 'OK'){
                    alert(result);
                }else{
                    document.location.reload();
                }                
            },
            error: function (response) {
                alert('Ошибка');
            },
        });
    });
});

function clearInput(valueName) {
    let valueCheck = (document.getElementById(valueName + 'Check')).checked;

    if(!valueCheck){
        document.getElementById(valueName + 'Value').value = 0;
    }else{
        document.getElementById(valueName + 'Value').value = (document.getElementById(valueName + 'Set')).value;        
    }
}

function numberWithSpaces(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
  }

$( "#extraShiftCheck" ).click(function() {
    let amountPay = Number(document.getElementById('amountPay').dataset.value);
    let extraShiftSet = Number(document.getElementById('extraShiftSet').value);
    let hourlyPayCheck = document.getElementById('hourlyPayCheck').checked;
    let hourlyPaySet = Number(document.getElementById('hourlyPaySet').value);
    let hours = Number(document.getElementById('bendingHours').value);
    let fine = Number(document.getElementById('fine').value);
    let bonus = Number(document.getElementById('Rub').value);

    let summ = 0;
    for (let i = 1; i <= 5; i++) {
        summ += Number(document.getElementById('item' + i + 'count').value) * Number(document.getElementById('item' + i + 'cost').value);
    }
    summ = (summ + bonus) - fine;

    if(this.checked){
        if(hourlyPayCheck){
            amountPay = hourlyPaySet * hours;
            document.getElementById('amountPay').innerText = numberWithSpaces((hourlyPaySet * hours) +  extraShiftSet) + ' ₽';
        }else{
            document.getElementById('amountPay').innerText = numberWithSpaces(summ +  extraShiftSet) + ' ₽';
        }        
    }else{
        if(hourlyPayCheck){
            document.getElementById('amountPay').innerText = numberWithSpaces(hourlyPaySet * hours) + ' ₽';
        }else{
            document.getElementById('amountPay').innerText = numberWithSpaces(summ) + ' ₽';
        }
    }
    
});

$( "#hourlyPayCheck" ).click(function() {
    // let amountPay = Number(document.getElementById('amountPay').dataset.value);
    let hourlyPaySet = Number(document.getElementById('hourlyPaySet').value);
    let hours = Number(document.getElementById('bendingHours').value);
    let extraShiftCheck = document.getElementById('extraShiftCheck').checked;

    let fine = Number(document.getElementById('fine').value);
    let bonus = Number(document.getElementById('Rub').value);
    let extraShiftValue = Number(document.getElementById('extraShiftValue').value);

    let summ = 0;
    for (let i = 1; i <= 5; i++) {
        summ += Number(document.getElementById('item' + i + 'count').value) * Number(document.getElementById('item' + i + 'cost').value);
    }
    summ = (summ + bonus) - fine;

    if(this.checked){
        if(extraShiftCheck){
            document.getElementById('amountPay').innerText = numberWithSpaces((hourlyPaySet *  hours) + extraShiftValue) + ' ₽';
        }else{
            document.getElementById('amountPay').innerText = numberWithSpaces(hourlyPaySet *  hours) + ' ₽';
        }       
    }else{
        if(extraShiftCheck){
            document.getElementById('amountPay').innerText = numberWithSpaces(summ + extraShiftValue) + ' ₽';
        }else{
            document.getElementById('amountPay').innerText = numberWithSpaces(summ) + ' ₽';
        }        
    }
    
});


$( "#userSettings" ).click(function() {
    let user = document.getElementById('userSettingsContent');
    let settingsForm = document.getElementById('settingsForm');
    user.classList.toggle('hide');
    settingsForm.classList.toggle('hide');
});



