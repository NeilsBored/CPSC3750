// Shane John
// 06/14/2025
// CPSC 3750
// program exam #1 
// Grade A...I Think

//Function that is Proably an inefficient way determine prime numbers
function primeOrNah(n) 
{
    //check for 1 or less
    if (n < 2)
        return false;
    //loop to nxn
    for (let i = 2 ; i <= Math.sqrt(n); i++)
    {
        //can it be divided by anything else than 1?
        if ((n % i) === 0) 
            return false;
    }
    return true;
}   

//Function to fill-in both lists; default 50 
function start() 
{
    //Grab user input for loop
    const input = document.getElementById('userInput').value
        let number = parseInt(input);
        if (number<1 || isNaN(number))
        {
            number=50; //Default
        }
    const primesList = document.getElementById('primesList')
    const notPrimesList = document.getElementById('notPrimesList')

    //Clear lists
    primesList.innerHTML = '';
    notPrimesList.innerHTML = '';

    //Loop to Sort, then fill
    for (let i = 1; i <= number; i++)
    {
        const li = document.createElement('li');
        li.textContent = i;

        //Sort
        if (primeOrNah(i))
        {
            primesList.appendChild(li);//Fill Prime
        }
        else
        {
            notPrimesList.appendChild(li);//Fill Non-prime
        }
    }
}

//Color Changing Lists
const colors = ['#f8bbd0', '#c8e6c9', '#b3e5fc', '#ffff99'];
let colorIndex = 0;
setInterval(() => 
    {
        //Increment color Id - Prime
        document.getElementById('primesList').parentElement.style.backgroundColor = colors[colorIndex];
        //Increment color Id + 1 - Not Prime
        document.getElementById('notPrimesList').parentElement.style.backgroundColor = colors[(colorIndex + 1) % colors.length];
        //Increase id
        colorIndex = (colorIndex + 1) % colors.length;
    }, 
    3000); //Time Interval


//SUMs Function
function listTotal(type)
{
    //Setup list set
    const listId = type === 'primes' ? 'primesList' : 'notPrimesList';
    const numbers = document.getElementById(listId).getElementsByTagName('li');
    
    //Loop and add
    let sum=0;
    for (let number of numbers) 
    {
        sum += parseInt(number.textContent);
    }
    //output for total
    document.getElementById(`${type}Sum`).textContent = `Sum: ${sum}`;
}



