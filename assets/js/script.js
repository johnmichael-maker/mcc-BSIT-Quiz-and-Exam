let adminDOM = document.querySelector(".__admin");
const indexDOM = document.getElementById('__index');
let submitForm = document.forms["add-question"];
let timer = document.getElementById("timer");
const signupForm = document.forms['signup'];
let time = 5000;
let userData = [];



let letters = ["A", "B", "C", "D"];

let questions = [
  {
    id: 1,
    question: "It is called as the brain of computer?",
    choices: [
      "Mother Board",
      "Solid State Drive",
      "Central Processing Unit",
      "Automatic Voltage Regulator",
    ],
    answer: "Central Processing Unit",
    category: 0,
    status: 2,
  },
  {
    id: 1,
    question: "It is called as the brain of computer?",
    choices: [
      "Mother Board",
      "Solid State Drive",
      "Central Processing Unit",
      "Automatic Voltage Regulator",
    ],
    answer: 2,
    category: 0,
    status: 1,
  },
];

const activateTooltip = () => {
  let tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
};

const getContestantsData = () => {
  let datas = [
    {
      fname: "John",
      lname: "Doe",
      Year: "1st",
      status: "active",
      average: "20/30",
    },
    {
      fname: "Been",
      lname: "Teen",
      Year: "1st",
      status: "active",
      average: "19/30",
    },
    {
      fname: "Shinra",
      lname: "Tensie",
      Year: "1st",
      status: "eliminated",
      average: "18/30",
    },
    {
      fname: "John",
      lname: "Doe",
      Year: "1st",
      status: "active",
      average: "20/30",
    },
    {
      fname: "Been",
      lname: "Teen",
      Year: "1st",
      status: "active",
      average: "19/30",
    },
    {
      fname: "Shinra",
      lname: "Tensie",
      Year: "1st",
      status: "eliminated",
      average: "18/30",
    },
    {
      fname: "John",
      lname: "Doe",
      Year: "1st",
      status: "active",
      average: "20/30",
    },
    {
      fname: "Been",
      lname: "Teen",
      Year: "1st",
      status: "active",
      average: "19/30",
    },
    {
      fname: "Shinra",
      lname: "Tensie",
      Year: "1st",
      status: "eliminated",
      average: "18/30",
    },
    {
      fname: "John",
      lname: "Doe",
      Year: "1st",
      status: "active",
      average: "20/30",
    },
    {
      fname: "Been",
      lname: "Teen",
      Year: "1st",
      status: "active",
      average: "19/30",
    },
    {
      fname: "Shinra",
      lname: "Tensie",
      Year: "1st",
      status: "eliminated",
      average: "18/30",
    },
  ];

  return datas;
};

const activateDataTable = () => {
  let datas = getContestantsData();
  const tableBody = document.querySelector("tbody");
  let tr = "";

  let i = 1;

  datas.forEach((data) => {
    let status = `<span class="badge bg-success">${data.status}</span>`;
    if (data.status === "eliminated") {
      status = `<span class="badge bg-danger">${data.status}</span>`;
    }

    tr += `
              <tr>
              <td>${i++}</td>
              <td>${data.fname}${data.lname}</td>
              <td>${data.year}</td>
              <td>${status}</td>
              <td>${data.average}</td>
              </tr>
          `;
  });

  tableBody.innerHTML = tr;

  $("#table").DataTable({
    data: datas.data,
    columns: [
      { data: "#" },
      { data: "Name" },
      { data: "Year" },
      { data: "Status" },
      { data: "Average" },
    ],
    pageLength: 3,
  });
};

const categoriesList = () => {
  const categories = ["Easy", "Medium", "Hard"];
  return categories;
};

const updateQuestions = (data) => {
  questions.push(data);
};

const questionsList = () => {
  return questions;
};

const getQuestions = () => {
  let categories = categoriesList();
  const questionRow = document.getElementById("questions-row");

  for (let i = 0; i < questions.length; i++) {
    let nextQuestion;
    let col = document.createElement("div");
    col.setAttribute("class", "col-3");
    let categoryStatus = `<span class="badge bg-success">${
      categories[questions[i].category]
    }</span>`;

    if (questions[i].category === 1) {
      categoryStatus = `<span class="badge bg-warning">${
        categories[questions[i].category]
      }</span>`;
    } else if (questions[i].category === 2) {
      categoryStatus = `<span class="badge bg-danger">${
        categories[questions[i].category]
      }</span>`;
    }

    if (i === 0) {
      nextQuestion = '<p class="badge bg-danger">Next Question</p>';
    } else {
      nextQuestion = "";
    }

    if (questions[i].status === 1) {
      col.innerHTML = `
      <div class="card h-100">
          <div class="card-body">
              <div class="d-flex justify-content-between">
                  ${nextQuestion}
                  <p class="text-muted">Category: ${categoryStatus}</p>
              </div>
              <div class="align-self-center">
                <p class="pt-2">${questions[i].question}</p>
              </div>
          </div>
      </div>
      `;
      questionRow.appendChild(col);
    }
  }
};

const hideModal = (id) => {
  const modalId = document.getElementById(id);
  const modal = bootstrap.Modal.getInstance(modalId);
  modal.hide();
};

const addQuestion = (form) => {
  const questionRow = document.getElementById("questions-row");
  const categories = categoriesList();

  // let questionList = setQuestionList()
  let alert = document.getElementById("alert");
  let datas = [
    form["question"],
    form["A"],
    form["B"],
    form["C"],
    form["D"],
    form["correct"],
    form["category"],
    1,
  ];

  datas.forEach((data) => {
    if (data.value == "") {
      alert.classList.add("alert", "alert-danger", "py-1", "mb-2");
      alert.innerHTML = "All fields are required";
    }
  });

  hideModal("add-question");

  // ADD TO DATABASE
  questions.push({
    id: 5,
    question: datas[0].value,
    choices: ["RAM", "CPU", "Hard Disk", "CD-ROM"],
    answer: "RAM",
    category: 2,
    status: 1,
  });

  // CREATE NEW ELEMENT

  const dataCategory = parseInt(datas[6].value);

  let col = document.createElement("div");
  col.setAttribute("class", "col-3");

  let categoryStatus = `<span class="badge bg-success">${
    categories[parseInt(datas[6].value)]
  }</span>`;

  if (dataCategory === 1) {
    categoryStatus = `<span class="badge bg-warning">${categories[dataCategory]}</span>`;
  } else if (dataCategory === 2) {
    categoryStatus = `<span class="badge bg-danger">${categories[dataCategory]}</span>`;
  }

  col.innerHTML = `
    <div class="card h-100">
          <div class="card-body">
              <div class="d-flex justify-content-between">
                  <p class="text-muted">Category: ${categoryStatus}</p>
              </div>
              <div class="align-self-center">
                <p class="pt-2">${datas[0].value}</p>
              </div>
          </div>
      </div>
    `;
  questionRow.appendChild(col);

  form.reset();
};

const getActiveQuestion = () => {
  let data;
  questions.forEach((question) => {
    if (question.status === 1) {
      data = question;
    }
  });

  return data;
};

const timerMs = () => {
    time -= 4
    if (time <= 0) {
      clearInterval(timerMs); // Stop the timer when time reaches zero or less
      timer.innerHTML = "Time's up!";
    } else {
      timer.innerHTML = time + "ms";
    }
};

const addAnswer = (data) => {
  console.log(data);
}

const signup = (data) => {
  console.log(data);
}

if (submitForm) {
  submitForm.onsubmit = () => {
    const form = document.forms["add-question"];
    event.preventDefault();
    addQuestion(form);
  };
}

if (adminDOM) {
  adminDOM.onload = () => {
    activateTooltip();
    activateDataTable();
    getQuestions();
  };
}

if (indexDOM) {
  indexDOM.onload = () => {
    let alertModal = document.getElementById("alert-modal");
    let alertMode = alertModal.querySelectorAll(".card");
    let questionNumber = document.getElementById("question-number");
    let questionDiv = document.getElementById("question");
    let choices = document.getElementById("choices");
    let activeQuestion = getActiveQuestion();
  
    questionNumber.innerHTML = activeQuestion.id;
    questionDiv.innerHTML = activeQuestion.question;
  
    let interval = setInterval(timerMs, 1)
  
    for (let i = 0; i < activeQuestion.choices.length; i++) {
      let choice = activeQuestion.choices;
      let col = document.createElement("div");
      col.setAttribute("class", "col-6");
      col.innerHTML = `
          <button class="w-100"><span>${letters[i]}</span> ${choice[i]} <i class="bx bx-check-circle"></i></button>
      `;
      choices.appendChild(col);
  
      // const time = timer()
  
      document.querySelectorAll("button")[i].onclick = () => {
        let data = [choice[i], time]
        addAnswer(data)
        if (activeQuestion.answer === i) {
          alertModal.classList.remove("d-none");
          alertMode[0].classList.remove("d-none");
          // countDown(0)
        }else{
          alertModal.classList.remove("d-none");
          alertMode[1].classList.remove("d-none");
        }
      };
    }
  }
}

if (signupForm) {
  signupForm.onsubmit = (e) => {
    e.preventDefault()
    let errors = document.querySelectorAll(".errors")
    const datas = [
      signupForm['fname'].value,
      signupForm['lname'].value,
      signupForm['mname'].value,
      signupForm['level'].value 
    ]
    
    if (datas[0] === '') { 
      errors[0].classList.remove("d-none")
      errors[0].innerHTML = "Please fill firstname"
    }else{
      errors[0].classList.add("d-none")
    }
  
    if (datas[1] === '') {
      errors[1].classList.remove("d-none")
      errors[1].innerHTML = "Please fill lastname"
    }else{
      errors[1].classList.add("d-none")
    }
  
    if (datas[0] !== '' && datas[1] !== '') {
      signup(datas)
    }
  
  }
}