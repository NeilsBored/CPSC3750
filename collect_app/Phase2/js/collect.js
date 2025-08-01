/*
  File: collect.js
  Author: Shane John
  Date: 2025-07-23
  Course: CPSC 3750 – Web Application Development
  Purpose: Client-side functions to bridge to the server-side of the app
  Notes: I'm still thinking of how to reduce the # of lines for this one.
*/

// For debugging
'use strict';

document.addEventListener('DOMContentLoaded', () => 
{
    // Varable needs for elements
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');
    const resultsBody = document.getElementById('resultsBody');

    // Initialize with empty query
    fetchMovies('');

    // Simple search on button push
    searchForm.addEventListener('submit', event => 
    {
        event.preventDefault();
        fetchMovies(searchInput.value.trim());
    });
    
  /*
   * Parameters: fun(Function) - The function being "debounced"
                 wait(number) - The delay you want in milliseconds.
   * Returns:    Nothing, then something.
   * Creates and returns a "debounced" function that delays 
   * invoking `fun` function until after a set waiting period.
   */
    function deflate(fun, wait) 
    {
        let timeout;
        return function(...args) 
        {
            clearTimeout(timeout);
            timeout = setTimeout(() => fun.apply(this, args), wait);
        };
    }
    // Live Search 
    searchInput.addEventListener('input', deflate(() => 
    {
        fetchMovies(searchInput.value.trim());
    }, 300));

    /*
     * Parameters: query(string) - The search term to be fetched.
     * Returns:    n/a
     * Fetches movie data from the API proxy using the provided "query", 
     * then passes a JSON response for rendering.
     */
    function fetchMovies(query) 
    {
        const url = `api/api_proxy.php?title=${encodeURIComponent(query)}&max=20&lang=en-US`;
        fetch(url)
            .then(response => response.json())
            .then(renderResults)
            // Search failure message
            .catch(error => 
            {
                console.error('Fetch error:', error);
                resultsBody.innerHTML = '<tr><td colspan="5">An error occurred while fetching movies.</td></tr>';
            });
    }

    /*
     * Parameters: data (Array) - JSON response array of movies (or an error object..but I hope its the first thing).
     * Returns:    void
     * Clears previous results and re-populates the table body with movie rows.
     */
    function renderResults(data) 
    {
        resultsBody.innerHTML = '';
        if (Array.isArray(data) && data.length > 0) 
        {
            data.forEach(addRow);
        } 
        else if (data.error && data.message) 
        {
            resultsBody.innerHTML = `<tr><td colspan="5">${data.message}</td></tr>`;
        } 
        else 
        {
            resultsBody.innerHTML = '<tr><td colspan="5">No results found.</td></tr>';
        }
    }

    /*
     * Parameters: movie(Object) - A movie object containing api dataset.
     * Returns:    void n/a
     * Creates table row with each movie's details w/ action buttons, 
     * then appends it to the results table.
     */
    function addRow(movie) 
    {
        const tr = document.createElement('tr');
        const cells = 
        [
            createImageCell(movie.poster_url || 'Image Not Found'), 
            createCell(movie.title || 'Untitled'),
            createCell(movie.release_date || 'Unknown'),
            createCell(movie.rating ? parseFloat(movie.rating).toFixed(1) : 'N/A'),
            createButtonCell('View Details', 'details-btn', () => 
            {
                window.location.href = `details.php?title=${encodeURIComponent(movie.title || '')}`;
            }),
            createButtonCell('Add to Collection', 'add-btn', btn => 
            {
                addToCollection(movie, btn);
            })
        ];
        cells.forEach(cell => tr.appendChild(cell));
        resultsBody.appendChild(tr);
    }

    /*
     * Parameters: text(string) - The text content for the table cell.
     * Returns:    td(Table Element) - an element containing the provided text.
     * Generates and returns a table cell set to the entered `text`.
     */
    function createCell(text) 
    {
        const td = document.createElement('td');
        td.textContent = text;
        td.style.fontWeight = 'bold';
        return td;
    }

    /*
     * Parameters: imgSrc(string) - The image URL for the movie poster.
     * Returns:    td(Table Element) - An element containing an img element.
     * Generates a table cell with an image element.
     */
    function createImageCell(imgSrc) 
    {
        const td = document.createElement('td');
        const img = document.createElement('img');
        img.src = imgSrc;
        img.alt = 'Poster';
        img.width = 100; 
        img.style.borderRadius = '10px'; 
        img.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.67)';             
        td.appendChild(img);
        return td;
    }

    /*
     * Parameters: label(string) - button text
                   className(string) - class for stylings 
                   onClick(Function) - click handler receiving the button element.
     * Returns:    td(Table Element) - a <td> element containing the configured <button>.
     * Creates a table cell with a button created using the
     * provided label, class, and its click behavior.
     */
    function createButtonCell(label, className, onClick) 
    {
        const td = document.createElement('td');
        const btn = document.createElement('button');
        btn.className = className;
        btn.textContent = label;
        btn.addEventListener('click', () => onClick(btn));
        td.appendChild(btn);
        return td;
    }

    /*
     * Parameters: movie(Object) - The movie data being added
                   button(Button Element) - The button that triggers POST action.
     * Returns:    none
     * Acts as form submit and sends POST request with movie details  to the public collection.
     */
    function addToCollection(movie, button) 
    {
        // Parse movie object
        const payload = 
        {
            title: movie.title || '',
            release_date: movie.release_date ?? null,
            rating: movie.rating ? parseFloat(movie.rating) : null,
            overview: movie.overview || '',
            poster: movie.poster_url || ''
        };
        // Post to movies table
        fetch('db/moviesTable_add.php',
        {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(payload)
        })
        .then(response => response.json())
        // Check for success + adjust button (not currently tracked)
        .then(result => 
        {
            if (result.status === 'success') 
            {
                button.disabled = true;
                button.textContent = 'In Collection';
                button.style.backgroundColor = 'black';
            } 
            else 
            {
                alert('Failed to add movie: ' + (result.error || 'Unknown error'));
            }
        })
        // Error out if fetch fails
        .catch(error => {
            console.error('Add error:', error);
            alert('An error occurred while adding the movie to your collection.');
        });
    }
});