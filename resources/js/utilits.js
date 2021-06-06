export const getFetch = async (url) => {
    const i = await fetch(url);
    return await i.json();
}

export const getDate = (d) => {
    let date; 
    let month;
    let year;
    let days;
    let day_start;
    let day_end;

    d = d ?? new URLSearchParams(location.search).get('date');

    if (!d) {
        date = new Date();
    } else {
        date = new Date(d);
    } 

    month = date.getMonth() + 1;
    year = date.getFullYear();
    days = new Date(date.getFullYear(), month, 0).getDate();
    month = month > 9 ? month : '0' + month;   
    day_start = new Date(date.getFullYear(), month - 1).getDay();
    day_end = new Date(date.getFullYear(), month - 1, days).getDay();

    return {
        year,
        month,
        show: year + '-' + month,
        days,
        day_start,
        day_end
    }
}

export const getSearchToUrl = (url) => {
    const urlSP = new URLSearchParams(url ?? window.location.search);

    let s = {};

    urlSP.forEach((v,n) => Object.assign(s, { [n]: v }));

    return s;
}

export const abbreviatedName = (surname, name, patronymic) => {
    return `${ surname } ${ name[0] }. ${ patronymic[0] }.`;
}

export const isAdmin = (id) => {
    return id === 1;
}
export const canAdmin = (id) => {
    return id === 1;
}