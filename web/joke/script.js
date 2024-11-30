const C = document.querySelector("canvas"),
  $ = C.getContext("2d"),
  W = (C.width = window.innerWidth),
  H = (C.height = window.innerHeight);

let plainNames = "Мне вас (искренне) жаль, Вам не дают, Маленький член, Под одну гребенку, Не все такие, Меня не знаете, Нищеброд, Нытик, Обиженка, Зол на женский род, Тогда сиди и онанируй, Тогда сидите и онанируйте друг другу, Бред, Чушь, У меня или подруг не так, Не там искали, Все разные, Не те попадались, А ваша мама, А ваша сестра, А ваша дочь, Этим вы оскорбили всех женщин, Настоящий мужик должен, Немужик, Мужчинка, Членоносец, Девственник, Импотент, Гей, Петушок, Никакого уважения к женщинам, Попробуй роди, Тебя родила женщина, Диван, Пиво, Носки, Мамины котлеты, С вами на ты не переходила, Перестаньте писать мне в ответ, Неудачник, Бедненткий, У вас комплексы, Женоненавистник, Женщин надо пропускать уступать им добиваться, ...быть достоин женщины, В дурдоме интернет провели, Псих или школьник, Изолировать, Многабукаф, Лень читать, Смог лишь это скопировать, Женщины сами могут зарабатывать, Мужики хуже баб, А вы женаты, Найдете себе девушку, Устроите личную жизнь, Ой всё, Админ помоги, Забанти";

let names = plainNames.split(", ");
let cols = [];

let font = 11,
  col = W / font,
  row = H / font,
  arr = [];

for (let i = 0; i < col; i++) 
{
  arr[i] = 1;
  cols[i] = "*";
}

function CreateRow()
{
  let name = names[Math.floor(Math.random() * names.length)].split("");
  let symbNum = Math.floor(Math.random() * (name.length - 1));
  let ind = 0;
  var fillRow = [];
  while(fillRow.length <= row)
  {
      if (symbNum >= name.length)
      {
        fillRow[ind] = "•";
        ind++
        name = names[Math.floor(Math.random() * names.length)].split("");
        symbNum = 0;
      }
      fillRow[ind] = name[symbNum];
      ind++
      symbNum++;
  }
  return fillRow;
}

function draw() 
{
  $.fillStyle = "rgba(0,0,0,.05)";
  $.fillRect(0, 0, W, H);
  $.fillStyle = "#0f0";
  $.font = font + "px system-ui";
  for (let i = 0; i < arr.length; i++) 
  {
    if (arr[i] == 1)
    {
      cols[i] = "hello wow are hello wow are hello wow are hello wow are hello wow are hello wow are hello wow are hello wow are hello wow are hello wow are hello wow are hello wow are hello wow are hello wow are hello wow are ".split("");
      cols[i] = CreateRow();
    }
    let txt = cols[i][arr[i]-1];
    $.fillText(txt, i * font, arr[i] * font);
    if (arr[i] * font > H && Math.random() > 0.975) arr[i] = 0;      
    arr[i]++;
  }
}

setInterval(draw, 123);

window.addEventListener("resize", () => location.reload());