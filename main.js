//Formatte les chiffres avec k M et G
function kFormatter(num) {
    if(Math.abs(num)>999999999)
    {
        return Math.sign(num)*((Math.abs(num)/1000000000).toFixed(3)) + ' G';
    }
    else if(num>999999)
    {
        return Math.sign(num)*((Math.abs(num)/1000000).toFixed(3)) + ' M'
    }
    else if (num>999) {
        return Math.sign(num)*((Math.abs(num)/1000).toFixed(1)) + ' k'
    }
    else
    {
        return Math.sign(num)*Math.abs(num)
    }
}

//Récupère tous les nombres
const numbers=document.querySelectorAll('span[data-toFormat]')
numbers.forEach(num=>{
    let number=num.dataset.toformat
    num.innerHTML=kFormatter(number)
})