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
    let hourlyPayCheck = (document.getElementById('addHourlyPayCheck')).checked;
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

function summCalc(type, rate) {

    if(type == 'bending'){
        let hourlyPayCheck = (document.getElementById('addHourlyPayCheck')).checked;
        let extraShiftCheck = (document.getElementById('addExtraShiftCheck')).checked;
        let paySummBending = document.getElementById('paySummBending');
        let addNote = document.getElementById('addNote');
        let extraShiftValue = Number(document.getElementById('extraShiftValue').value);

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
        let item1factor = Number((document.getElementById('item1factor')).value);
        let item2factor = Number((document.getElementById('item2factor')).value);
        let item3factor = Number((document.getElementById('item3factor')).value);
        let item4factor = Number((document.getElementById('item4factor')).value);
        let item5factor = Number((document.getElementById('item5factor')).value);

        let product = (
            (item1count * item1factor) + 
            (item2count * item2factor) + 
            (item3count * item3factor) + 
            (item4count * item4factor) + 
            (item5count * item5factor)
        );

        let summ = 0;
        
        if(hourlyPayCheck == true){

            let hours = (document.getElementById('bendingHours')).value;
            let extraBonusInput = document.getElementById('extraBonus');
            let hourlyPayValue = (document.getElementById('hourlyPayValue')).value;
            let Fine = Number((document.getElementById('fine')).value);
            let Bonus = Number((document.getElementById('Rub').value));  
            rate = Number(rate);

            if(rate > 0){
                if( product < (rate * 1.2) ){
                    extraBonus = 0;
                    addNote.value = '';              
                }else if( (product >= (rate * 1.2)) && (product < (rate * 1.4)) ){
                    extraBonus = 300;
                    addNote.value = 'Доп. премия 300 руб. за +20% к норме';
                }else if( (product >= (rate * 1.4)) && (product < (rate * 1.6)) ){
                    extraBonus = 600;
                    addNote.value = 'Доп. премия 600 руб. за +40% к норме';
                }else if( (product >= (rate * 1.6)) && (product < (rate * 1.8)) ){
                    extraBonus = 900;
                    addNote.value = 'Доп. премия 900 руб. за +60% к норме';
                }else if( (product >= (rate * 1.8)) && (product < (rate * 2)) ){
                    extraBonus = 1200;
                    addNote.value = 'Доп. премия 1200 руб. за +80% к норме';
                }else if( (product >= (rate * 2)) ){
                    extraBonus = 1500;
                    addNote.value = 'Доп. премия 1500 руб. за +100% к норме';
                }
            }else{
                extraBonus = 0;
            }
            
            extraBonusInput.value = extraBonus;
            summ = ((hours * hourlyPayValue) + Bonus + extraBonus) - Fine;

        }else{

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
    let editBendingDay = document.getElementById('editBendingDay');    
    let inputs = table.getElementsByTagName('input');
    let saveBendingValues = document.getElementById('saveBendingValues'); 
    let SelectTime = document.getElementById('SelectTime');
    let addNote = document.getElementById('addNote');

    if(editBendingDay.value == 'Изменить'){

        for (let input of inputs) {
            input.disabled = false;
        }
        saveBendingValues.disabled = false;
        addNote.disabled = false;
        saveBendingValues.classList.remove("notActiveBtn");
        SelectTime.disabled = false;
        editBendingDay.value = 'Отмена';

    }else if (editBendingDay.value == 'Отмена') {
        
        for (let input of inputs) {
            input.disabled = true;
        }
        saveBendingValues.disabled = true;
        addNote.disabled = true;
        saveBendingValues.classList.add("notActiveBtn");
        SelectTime.disabled = true;
        editBendingDay.disabled = false;
        editBendingDay.value = 'Изменить';
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
                temp = result.split(':');
                date = temp[0].split('-');
                flag = temp[1];

                if(flag == 'save'){
                    alert('Запись сохранена!');
                    document.location = '/single.php?day=' + date[2] + '&month=' + date[1] + '&year=' + date[0];
                }else{
                    if(flag == 'delete'){
                        alert('Запись удалена!');
                        document.location = ('/');
                    }                    
                }                          
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

function getProductCount(){
    let item1count = Number(document.getElementById('item1count').value);
    let item2count = Number(document.getElementById('item2count').value);
    let item3count = Number(document.getElementById('item3count').value);
    let item4count = Number(document.getElementById('item4count').value);
    let item5count = Number(document.getElementById('item5count').value);

    let item1factor = Number(document.getElementById('item1factor').value);
    let item2factor = Number(document.getElementById('item2factor').value);
    let item3factor = Number(document.getElementById('item3factor').value);
    let item4factor = Number(document.getElementById('item4factor').value);
    let item5factor = Number(document.getElementById('item5factor').value);

    return ((item1count * item1factor) + (item2count * item2factor) + (item3count * item3factor) + (item4count * item4factor) + (item5count * item5factor));
}

function getPiecework(){
    let item1count = Number(document.getElementById('item1count').value);
    let item2count = Number(document.getElementById('item2count').value);
    let item3count = Number(document.getElementById('item3count').value);
    let item4count = Number(document.getElementById('item4count').value);
    let item5count = Number(document.getElementById('item5count').value);

    let item1cost = Number(document.getElementById('item1cost').value);
    let item2cost = Number(document.getElementById('item2cost').value);
    let item3cost = Number(document.getElementById('item3cost').value);
    let item4cost = Number(document.getElementById('item4cost').value);
    let item5cost = Number(document.getElementById('item5cost').value);

    return ((item1count * item1cost) + (item2count * item2cost) + (item3count * item3cost) + (item4count * item4cost) + (item5count * item5cost));
}

function getNote(product, rate){
    if( product < (rate * 1.2) ){
        return '';              
    }else if( (product >= (rate * 1.2)) && (product < (rate * 1.4)) ){
        return '+300 ₽ (+20%)';
    }else if( (product >= (rate * 1.4)) && (product < (rate * 1.6)) ){
        return '+600 ₽ (+40%)';
    }else if( (product >= (rate * 1.6)) && (product < (rate * 1.8)) ){
        return '+900 ₽ (+60%)';
    }else if( (product >= (rate * 1.8)) && (product < (rate * 2)) ){
        return '+1200 ₽ (+80%)';
    }else if( (product >= (rate * 2)) ){
        return '+1500 ₽ (+100%)';
    }
}

function reCalculate(obj, rate) {
    let hourlyPayCheck = document.getElementById('hourlyPayCheck').checked;

    let bendingHours = Number(document.getElementById('bendingHours').value);
    let fine = Number(document.getElementById('fine').value);
    let bonus = Number(document.getElementById('Rub').value);
    let hourlyPayValue = Number(document.getElementById('hourlyPayValue').value);
    let extraShiftValue = Number(document.getElementById('extraShiftValue').value);

    let textarea = document.getElementById("addNote");

    let summ = 0;
    let hours = 0;
    let product = 0;
    let payPerHours = 0;
    let extraBonus = 0;

    hours = bendingHours;
    product = getProductCount();
    payPerHours = Math.round((summ / hours), -1);    


    let note = textarea.value;
    let index = (note.indexOf('%)' + '\n')) + 3;

    if( product < (rate * 1.2) ){
        extraBonus = 0;
        if((note.indexOf('00 ₽ ')) < 0){
            newNote = note; 
        }else{
            newNote = note.slice(index); 
        }
                   
    }else if( (product >= (rate * 1.2)) && (product < (rate * 1.4)) ){
        extraBonus = 300;
        if((note.indexOf('00 ₽ ')) < 0){
            newNote = '+300 ₽ (+20%)' + '\n' + note;
        }else{
            newNote = '+300 ₽ (+20%)' + '\n' + note.slice(index); 
        }  

    }else if( (product >= (rate * 1.4)) && (product < (rate * 1.6)) ){
        extraBonus = 600;
        if((note.indexOf('00 ₽ ')) < 0){
            newNote = '+600 ₽ (+40%)' + '\n' + note;
        }else{
            newNote = '+600 ₽ (+40%)' + '\n' + note.slice(index); 
        }

    }else if( (product >= (rate * 1.6)) && (product < (rate * 1.8)) ){
        extraBonus = 900;
        if((note.indexOf('00 ₽ ')) < 0){
            newNote = '+900 ₽ (+60%)' + '\n' + note;
        }else{
            newNote = '+900 ₽ (+60%)' + '\n' + note.slice(index); 
        }

    }else if( (product >= (rate * 1.8)) && (product < (rate * 2)) ){
        extraBonus = 1200;
        if((note.indexOf('00 ₽ ')) < 0){
            newNote = '+1200 ₽ (+80%)' + '\n' + note;
        }else{
            newNote = '+1200 ₽ (+80%)' + '\n' + note.slice(index); 
        }

    }else if( (product >= (rate * 2)) ){
        extraBonus = 1500;
        if((note.indexOf('00 ₽ ')) < 0){
            newNote = '+1500 ₽ (+100%)' + '\n' + note;
        }else{
            newNote = '+1500 ₽ (+100%)' + '\n' + note.slice(index); 
        }
    }

    textarea.value = newNote; 
    
    if(hourlyPayCheck){
        summ = ((bendingHours * hourlyPayValue) + bonus + extraBonus + extraShiftValue) - fine;
    }else{
        summ = ((getPiecework()) + bonus + extraBonus + extraShiftValue) - fine;
    }    

    document.getElementById('amountPay').innerHTML = numberWithSpaces(summ) + ' &#8381;';
    document.getElementById('amountHours').innerHTML = hours + '<div class="infoBlockDesc">часов</div>';
    document.getElementById('amountProduct').innerHTML = product + '<div class="infoBlockDesc">едениц</div>';
    document.getElementById('amountPerHour').innerHTML = payPerHours + '<div class="infoBlockDesc">&#8381;/час</div>';

    
}

function numberWithSpaces(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
  }


$( "#userSettings" ).click(function() {
    let user = document.getElementById('userSettingsContent');
    let settingsForm = document.getElementById('settingsForm');
    user.classList.toggle('hide');
    settingsForm.classList.toggle('hide');
});

$( ".detailLink" ).click(function() {
    expDate = this.id.split('-');
    document.location = '/single.php?day=' + expDate[2] + '&month=' + expDate[1] + '&year=' + expDate[0];
});

function hideCostCol(checkbox){
    let cols = document.querySelectorAll('.costCol');

    for (let col of cols) {
        col.classList.toggle('hide');        
    }
}
