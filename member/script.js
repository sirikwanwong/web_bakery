const toggleButton = document.getElementsByClassName('toggle-button')[0]
const Button = document.getElementsByClassName('button')[0]

toggleButton.addEventListener('click', () => {
    Button.classList.toggle('active')
})