import axios from 'axios';

let name = document.getElementById('name');
let nameValidationResult = document.getElementById('name-validation-result');

const validateName = function () {
    nameValidationResult.innerText = '...';
    axios.post(nameValidationResult.dataset.path, {input: name.value})
        .then(function(response) {
            if (response.data.valid) {
                nameValidationResult.innerText = ":)";
            } else {
                nameValidationResult.innerText = ":(";
            }
        })
        .catch(function (error) {
            nameValidationResult.innerText = 'Error: ' + error;
        });
};

name.onkeyup = validateName;
name.onchange = validateName;

let team = document.getElementById('team');
let teamValidationResult = document.getElementById('team-validation-result');

const validateTeam = () => {
    teamValidationResult.innerText = '...';
    axios.post(teamValidationResult.dataset.path, {input: team.value})
      .then(function(response) {
          if (response.data.valid) {
              teamValidationResult.innerText = ':)';
          } else {
              teamValidationResult.innerText = ':(';
          }
      })
      .catch(function(error) {
        teamValidationResult.innerHtml = 'Error' + error;
      });
};

team.onkeyup = validateTeam;
team.onchange = validateTeam;
