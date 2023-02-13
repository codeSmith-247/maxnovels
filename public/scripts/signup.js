let date = new Date();
let start_year = date.getFullYear() - 100;
let end_year = date.getFullYear() - 7;

select('.year').appendChild(year_generator(start_year, end_year));
select('.day').appendChild(day_generator(1, 31));