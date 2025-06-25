/*
  File: events.js
  Author: Shane John
  Date: 2025-06-24
  Course: CPSC 3750 – Web Application Development
  Purpose: Handles events being listened for with Animation, Drag/Drop, Input, Mouse, and Focus
  Notes: The Specal Sauce of this assingment. Contains event all listeners and handlers.
*/

// Animation Events
const box = document.getElementById('box');
const animStatus = document.getElementById('animStatus');
box.addEventListener('animationstart', () => animStatus.textContent = 'Animation Started');
box.addEventListener('animationiteration', () => animStatus.textContent = 'Animation Repeated');
box.addEventListener('animationend', () => animStatus.textContent = 'Animation Ended');

// Drag Events
const dragMe = document.getElementById('dragMe');
const dropZone = document.getElementById('dropZone');
const dragStatus = document.getElementById('dragStatus');
dragMe.addEventListener('dragstart', element => {element.dataTransfer.setData('text/plain', 'dragMe');
    dragStatus.textContent = 'Drag Started';}
);
dragMe.addEventListener('dragend', () => {dragMe.style.opacity = '1'; 
    dragStatus.textContent = 'Drag Ended';}
);
dropZone.addEventListener('dragenter', element => {element.preventDefault();
    dropZone.classList.add('over');
    dragStatus.textContent = 'Drop Entered';}
);
dropZone.addEventListener('dragleave', () => {
    dropZone.classList.remove('over');
    dragStatus.textContent = 'Drop Zone Left';}
);
dropZone.addEventListener('dragover', element => {element.preventDefault();
    dragStatus.textContent = 'Over Drop Zone';}
);
dropZone.addEventListener('drop', element => {element.preventDefault();
    dropZone.classList.remove('over');
    dropZone.style.color = 'rgba(28, 166, 176, 0.93)';
    dropZone.textContent = 'Success!';}
);

// Input Events
const inputStatus = document.getElementById('inputStatus');
    textInput.addEventListener('input', () => {console.log('Current value:', textInput.value);
    inputStatus.textContent = 'Current Value: ' + textInput.value;}
);
textInput.addEventListener('change', () => {console.log('Final value:', textInput.value);
    inputStatus.textContent = 'Final Value: ' + textInput.value;}
);

// Mouse Events
const mouseArea = document.getElementById('mouseArea');
const mouseStatus = document.getElementById('mouseStatus');
mouseArea.addEventListener('mouseover', () => {
    mouseArea.style.background = 'linear-gradient(to right,rgb(63, 221, 87),rgb(0, 98, 52))';
    mouseArea.style.color = 'white';
    mouseStatus.textContent = 'Mouse Over';}
);
mouseArea.addEventListener('mouseout', ()  => {
    mouseArea.style.background = 'linear-gradient(to right,rgb(201, 201, 202),rgb(119, 119, 126))';
    mouseArea.style.color = 'black';
    mouseStatus.textContent = 'Mouse Out';}
);
mouseArea.addEventListener('click', ()  => {alert('You Clicked It!');
    mouseStatus.textContent = 'Mouse Click';}
);
mouseArea.addEventListener('mousedown', element => {console.log('Mouse down, button:', element.button);
    mouseStatus.textContent = 'Mouse Down: ' + element.button;}
);
mouseArea.addEventListener('mousemove', element => {console.log(`Mouse at (${element.clientX}, ${element.clientY})`);
    mouseStatus.textContent = `Mouse Moved to (${element.clientX}, ${element.clientY})`;}
);
mouseArea.addEventListener('wheel', element => {console.log('Wheel delta:', element.deltaY);
    mouseStatus.textContent = 'Wheel Delta: ' + element.deltaY;}
);

// Focus Events
const area = document.getElementById('area');
const form = document.body;  
const focusStatus = document.getElementById('focusStatus');
area.addEventListener('focus', () => {
  area.style.border = '10px solid orange';
  area.style.background = 'linear-gradient(rgb(116, 0, 241),rgb(174, 123, 199))';
  area.style.color = 'white';
  area.style.placeholder.color = 'white';
  focusStatus.textContent = 'Focused';}
);
form.addEventListener('focusin', element => {element.target.tagName.match(/INPUT|TEXTAREA/) && element.target.classList.add('focused');
  focusStatus.textContent = 'Focus In';}
);
form.addEventListener('focusout', element => {element.target.classList.remove('focused');
  focusStatus.textContent = 'Focus Out';}
);
