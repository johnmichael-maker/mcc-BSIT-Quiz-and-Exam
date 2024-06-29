let adminDOM = document.querySelector(".__admin");
const indexDOM = document.getElementById("__index");
let submitForm = document.forms["add-question"];
let timer = document.getElementById("timer");
const signupForm = document.forms["signup"];
const loginForm = document.forms["login"];
let nextBtn = document.getElementById("next-question");
const nextQuestionBtn = document.getElementById("next-question-btn");
const questionRow = document.getElementById("questions-row");
let logOutBtn = document.getElementById("logout-btn")
let questionsFromDb = [];
let time = 5000;
let statusFetch;
let userData = [];
let statusContestant = ["Active", "Eliminated"];
let letters = ["A", "B", "C", "D"];
let questions = [];
let questionStatus = 'pending';
let choicesBtns = document.querySelectorAll("button");
let startBtn = document.getElementById("start")
let view = document.getElementById("__view")

const getDataFromDbGet = async (url) => {
  try {
    const response = await fetch(url);

    if (!response.ok) {
      throw new Error("Could not fetch resource");
    }
    const dataResponse = await response.json();
    return dataResponse;

  }catch(error){
    console.log(error);
  }
}


if (view) {

  const getViewGetContestants = async () =>{
    const response = await getDataFromDbGet("../function/Process.php?contestants");
    let viewCandidates = document.getElementById("candidates")
    let i = 1;
    response.forEach(contestant => {
      let status;
      if (contestant.status == 2) {
          status = `<span class="badge bg-danger">Eliminated</span>`;
        } else if (contestant.status == 1) {
          status = `<span><i class="bx bx-time-five"></i> ${(contestant.time == null) ? 0 : contestant.time}</span> `;
        }
      let col = document.createElement("div")
      col.setAttribute("class", "col-12")
      col.innerHTML = `
      <div class="col-12 p-2">
          <div class="row">
          <div class="col-2">
          <span class="rank px-3 ${(i === 1) ? ' bg-success text-light rounded-circle' : (i == 2) ? 'bg-warning text-light rounded-circle' : (i === 3) ? 'bg-danger text-light rounded-circle' : ''}">${i++}</span>
          </div>
          <div class="col-5">
          <h5>${contestant.fname} ${contestant.lname} ${contestant.mname}</h5>
          </div>
          <div class="col-2">
            <span><i class="bx bx-check"></i> ${(contestant.total_check_code == null) ? 0: contestant.total_check_code}/30</span>
          </div>
          <div class="col-2">
            ${status}
          </div>
          </div>
      </div>
      `
      viewCandidates.appendChild(col)
      
    })
  }

  const getNewDataFromDb = async () => {
    const dataResponse = await getDataFromDbGet("../function/Process.php?questions");
    
    const interval = setInterval(() => {
      time -= 2;
      if (time <= 0) {
        clearInterval(interval); // Stop the timer when time reaches zero or less
        timer.innerHTML = "Time's up!";
        nextBtn.classList.remove("d-none");
      } else {
        timer.innerHTML = time + "ms";
      }
    }, 1);

    dataResponse.forEach(data => {
      console.log("waiting....");
      if (data.status === 3 && data.activation == null) {
        window.location.href = "view.php"
      }

      if (dataResponse.length === 0) {
        let currentDiv = document.getElementById("current-question")
        currentDiv.classList.add("d-none")
        document.getElementById("no-record-question").classList.remove("d-none")
        if (view) {
          document.getElementById("view-question").innerHTML = "Waiting..."
        }
      }else{
        if(dataResponse[0].status === 1) {
          document.getElementById("view-question").innerHTML = "Waiting..."
        }else{
          for (let i = 0; i < dataResponse.length; i++) {
            if (dataResponse[i][8] === 3) {
              document.getElementById("view-question").innerHTML = dataResponse[i].question
              document.getElementById("view-A").innerHTML = `A. ${dataResponse[i].A}`
              document.getElementById("view-B").innerHTML = `B. ${dataResponse[i].B}`
              document.getElementById("view-C").innerHTML = `C. ${dataResponse[i].C}`
              document.getElementById("view-D").innerHTML = `D. ${dataResponse[i].D}`

              setTimeout(() => {
                if (dataResponse[i].answer == 0) {
                  document.getElementById("view-A").classList.replace("btn-light", "btn-danger")
                }else
                if (dataResponse[i].answer == 1) {
                  document.getElementById("view-B").classList.replace("btn-light", "btn-danger")
                }else if (dataResponse[i].answer == 2) {
                  document.getElementById("view-C").classList.replace("btn-light", "btn-danger")
                } if (dataResponse[i].answer == 3) {
                  document.getElementById("view-D").classList.replace("btn-light", "btn-danger")
                }

              }, 5000)

            }
          }
        }
        
      }
    })
  }
  setInterval(() => {
    getNewDataFromDb()
  }, 1000);
  getViewGetContestants()
}

const getAverage = async (data,array) => {
  try {
    const response = await fetch("../function/Process.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json; charset=utf-8",
      },
      body: JSON.stringify(data),
    });

    if (!response.ok) {
      throw new Error("Could not fetch resource");
    }
    const dataResponse = await response.json();

    console.log(dataResponse);

    let average = document.getElementById("average")

    console.log(array);
   
   for (let i = 0; i < dataResponse.length; i++) {
    if (dataResponse[i].contestant_id) {
      console.log("yo");
    }
   }

  } catch (error) {
    console.error(error);
  }
}

const getCurrentQuestion = async () =>{
  const dataResponse = await getDataFromDbGet("../function/Process.php?questions")
  let lastData = dataResponse.length
  let categories = categoriesList();

  if (dataResponse === 0) {
    let currentDiv = document.getElementById("current-question")
    currentDiv.classList.add("d-none")
    document.getElementById("no-record-question").classList.remove("d-none")

  }else{
    if(dataResponse[0].status === 1) {
      // console.log(dataResponse[0].status);
      document.getElementById("quest-div").classList.add("d-none")
      let currentCategory = document.getElementById("current-category");
      let quest = document.getElementById("question");
      let a = document.getElementById("A-choice");
      let b = document.getElementById("B-choice");
      let c = document.getElementById("C-choice");
      let d = document.getElementById("D-choice");
      a.classList.add("d-none")
      b.classList.add("d-none")
      c.classList.add("d-none")
      d.classList.add("d-none")
      currentCategory.innerHTML = "none"
    }else{
      for (let i = 0; i < dataResponse.length; i++) {
  
        if (dataResponse[i][8] === 3) {
          document.getElementById("quest-div").classList.remove("d-none")
  
          if (dataResponse[i].question_id === dataResponse.length) {
            nextQuestionBtn.classList.add("d-none")
          }
  
           if (lastData === dataResponse[i].question_id) {
             let col = document.createElement("div");
             col.setAttribute("class", "col-3");
             col.innerHTML = `
                       <div class="card h-100 bg-transparent border-0 shadow-0">
                           <div class="card-body ">
                              <p class="text-muted">No record found</p>
                           </div>
                       </div>
                     `;
                       questionRow.appendChild(col);
           }
           let currentCategory = document.getElementById("current-category");
           let quest = document.getElementById("question");
           let correctAns = document.getElementById("correct-answer")
           let a = document.getElementById("A-choice");
           let b = document.getElementById("B-choice");
           let c = document.getElementById("C-choice");
           let d = document.getElementById("D-choice");
     
           if (dataResponse[i].category == 1) {
             currentCategory.classList.replace("bg-success", "bg-warning")
           }else if (dataResponse[i].category == 2){
             currentCategory.classList.replace("bg-success", "bg-danger")
           }
          
          
           a.setAttribute("value", `A. ${dataResponse[i].A} `);
           b.setAttribute("value", `B. ${dataResponse[i].B} `);
           c.setAttribute("value", `C. ${dataResponse[i].C} `);
           d.setAttribute("value", `D. ${dataResponse[i].D} `);
           quest.innerHTML = dataResponse[i].question
           currentCategory.innerHTML = categories[dataResponse[i].category]
  
           let corrAns;
  
           if (dataResponse[i].answer == 0) {
            corrAns = 'A';
           }else if (dataResponse[i].answer == 1) {
            corrAns = 'B';
           }else if (dataResponse[i].answer == 2) {
            corrAns = 'C';
           }else if (dataResponse[i].answer == 3) {
            corrAns = 'D';
           }
  
           correctAns.innerHTML = `Correct Answer: ${corrAns}`
     
           document.getElementById("timer-div").classList.replace("d-none", "d-flex")
           document.getElementById("start-div").classList.add("d-none")
     
           nextQuestionBtn.onclick = () => {
             let idCurrentQuestion = dataResponse[i].question_id;
             let ids = {
               current: idCurrentQuestion,
               next: idCurrentQuestion+1
             }
             getNextQuestion(ids);
             nextQuestionBtn.setAttribute("disabled")
     
             // console.log(ids);
           };
         }
       }
    }
  }

}

const getQuestionFromDB = async () => {
  try {
    const response = await fetch("../function/Process.php?questions");

    if (!response.ok) {
      throw new Error("Could not fetch resource");
    }
    const dataResponse = await response.json();

    let categories = categoriesList();
    
    let count = 0;

    for (let i = 0; i < dataResponse.length; i++) {
      if (dataResponse[i][8] == 1) {
        let nextQuestion;
        let col = document.createElement("div");
        col.setAttribute("class", "col-3");
        let categoryStatus = `<span class="badge bg-success">${
          categories[dataResponse[i].category]
        }</span>`;

        if (dataResponse[i].category === 1) {
          categoryStatus = `<span class="badge bg-warning">${
            categories[dataResponse[i].category]
          }</span>`;
        } else if (dataResponse[i].category === 2) {
          categoryStatus = `<span class="badge bg-danger">${
            categories[dataResponse[i].category]
          }</span>`;
        }

        if (count++ === 0) {
          nextQuestion = '<p class="badge bg-danger">Next Question</p>';
        } else {
          nextQuestion = "";
        }

        // console.log(dataResponse[i].status);

        if (dataResponse[i].status == 1) {
          col.innerHTML = `
          <div class="card h-100">
              <div class="card-body">
                  <div class="d-flex justify-content-between">
                      ${nextQuestion}
                      <p class="text-muted">Category: ${categoryStatus}</p>
                  </div>
                  <div class="align-self-center">
                    <p class="pt-2">${dataResponse[i].question}</p>
                  </div>
              </div>
          </div>
        `;
          questionRow.appendChild(col);
        }
      }
    }
  } catch (error) {
    console.error(error);
  }
};

const getNextQuestion = async (data) => {
  try {
    console.log(data);
    const response = await fetch("../function/Process.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json; charset=utf-8",
      },
      body: JSON.stringify(data),
    });

    if (!response.ok) {
      throw new Error("Could not fetch resource");
    }
    const dataResponse = await response.text();
    if (dataResponse == 'success') {
      window.location.href = "index.php"
    }
  } catch (error) {
    console.error(error);
  }
};

const activateTooltip = () => {
  let tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
}

const getContestantsData = async () => {
  let datas;
  try {
    const response = await fetch("../function/Process.php?contestants");
    
    if (!response.ok) {
      throw new Error("Could not fetch resource");
    }
    const dataResponse = await response.json();

    let ids = [];
    const tableBody = document.querySelector("tbody");
    let tr = "";
    let contestant_id = [];
    let i = 1;
    
    if (dataResponse == 0) {
      getContestants()
      countMaxQuestion()
    } else {
      // Sort dataResponse by latest_time in descending order
      dataResponse.sort((a, b) => new Date(b.latest_time) - new Date(a.latest_time));

      dataResponse.forEach((data) => {
        let status;

        ids.push(data.contestant_id)
        if (data.status == 2) {
          status = `<span class="badge bg-danger">Eliminated</span>`;
        } else if (data.status == 1) {
          status = `<span class="badge bg-success">Active</span>`;
        }

        tr += `
              <tr>
                <td>${i++}</td>
                <td>${data.fname + " " + data.lname + " " + data.mname}</td>
                <td>${data.year}</td>
                <td>${(data.total_check_code == null) ? 0 : data.total_check_code} / <span class="max"></span></td>
                <td>${data.time}</td>
                <td>${status}</td>
              </tr>
            `;
        contestant_id.push(data.contestant_id);
      });

      function toObject(id) {
        let rv = {};
        for (let i = 0; i < ids.length; ++i)
          rv[i] = ids[i];
        return rv;
      }

      let dataIds = { get_average: toObject(ids) };
      getAverage(dataIds, contestant_id);

      tableBody.innerHTML = tr;

      $("#table").DataTable({
        data: datas,
        columns: [
          { data: "#" },
          { data: "Name" },
          { data: "Year" },
          { data: 'Average' },
          { data: "Status" },
          { data: "Time" },
        ],
        pageLength: 5,
      });
    }
    
  } catch (error) {
    console.error(error);
  }
  return datas;
};

const getContestants = async () => {
  let datas;
  let dataResponse = await getDataFromDbGet("../function/Process.php?contestantsData");
  console.log(dataResponse);
  const tableBody = document.querySelector("tbody");
  let tr = "";
  let contestant_id = [];
  let i = 1;

  if (dataResponse == 0) {
    let table = new DataTable("#table")
  }else{
    
    dataResponse.forEach((data) => {
      let status;
      if (data.status == 2) {
        status = `<span class="badge bg-danger">Eliminated</span>`;
      } else if (data.status == 1) {
        status = `<span class="badge bg-success">Active</span>`;
      }

      tr += `
            <tr>
              <td>${i++}</td>
              <td>${data.fname + " " + data.lname + " " + data.mname}</td>
              <td>${data.year}</td>
              <td>0 / <span class="max"></span></td>
              <td>0</td>
              <td>${status}</td>
            </tr>
          `;
      contestant_id.push(data.contestant_id);
    });


    tableBody.innerHTML = tr;

    $("#table").DataTable({
      data: datas,
      columns: [
        { data: "#" },
        { data: "Name" },
        { data: "Year" },
        { data: 'Average' },
        { data: "Status" },
        { data: "Time" },
      ],
      pageLength: 5,
    });
  }

}

const categoriesList = () => {
  const categories = ["Easy", "Medium", "Hard"];
  return categories;
};

const hideModal = (id) => {
  const modalId = document.getElementById(id);
  const modal = bootstrap.Modal.getInstance(modalId);
  modal.hide();
};

const insertQuestion = async (data) => {
  try {
    const response = await fetch("../function/Process.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json; charset=utf-8",
      },
      body: JSON.stringify(data),
    });

    if (!response.ok) {
      throw new Error("Could not fetch resource");
    }
    const dataResponse = await response.text();
    if (dataResponse === 'success') {
      getCurrentQuestion()
    }
  } catch (error) {
    console.error(error);
  }
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

  let questionData = {
    question: datas[0].value,
    A: datas[1].value,
    B: datas[2].value,
    C: datas[3].value,
    D: datas[4].value,
    correct: datas[5].value,
    category: datas[6].value,
  };

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

  insertQuestion(questionData);

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

const countMaxQuestion = async () =>{
  let response = await getDataFromDbGet('../function/Process.php?questions');
  let maxSpan = document.querySelectorAll(".max")
  console.log(maxSpan);
  maxSpan.forEach(max => {
    max.innerHTML = response.length
  });
}

const confirmQuestion = async (data) => {
  try {
    const response = await fetch("./function/Process.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json; charset=utf-8",
      },
      body: JSON.stringify(data),
    });

    if (!response.ok) {
      throw new Error("Could not fetch resource");
    }
    const dataResponse = await response.text();
    if (dataResponse === 'success') {
      window.location.href = "index.php"
    }
  } catch (error) {
    console.error(error);
  }
}

const getNewQuestion = () => {
  async function getResponseDataFromDb(){
    const dataResponse = await getDataFromDbGet("./function/Process.php?questions");
    dataResponse.forEach(data => {
      console.log("waiting....");
      if (data.status === 3 && data.activation == null) {
        questionStatus = "Active"
        confirmQuestion({question_id : data.question_id})
      }
    })
  }
  getResponseDataFromDb()
}

const disableAccount = async () => {
  const dataResponse = await getDataFromDbGet("./function/Process.php?disableAccount");
}

const addAnswer = async (data) => {
  try {
    const response = await fetch("./function/Process.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json; charset=utf-8",
      },
      body: JSON.stringify(data),
    });

    if (!response.ok) {
      throw new Error("Could not fetch resource");
    }
    const dataResponse = await response.text();
    console.log(dataResponse);
  } catch (error) {
    console.error(error);
  }
};

const signup = async (data) => {
  try {
    const response = await fetch("./function/Process.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json; charset=utf-8",
      },
      body: JSON.stringify(data),
    });

    if (!response.ok) {
      throw new Error("Could not fetch resource");
    }
    const dataResponse = await response.text();
    console.log(dataResponse);
    if (dataResponse === "success") {
      setTimeout(() => {
        window.location.href = "index.php";
      }, 6000);
    }
  } catch (error) {
    console.error(error);
  }
};

const login = async (data) => {
  try {
    const response = await fetch("../function/Process.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json; charset=utf-8",
      },
      body: JSON.stringify(data),
    });

    if (!response.ok) {
      throw new Error("Could not fetch resource");
    }
    const dataResponse = await response.text();
    console.log(dataResponse);

    let alert = document.getElementById("alert-success");
    let alertError = document.getElementById("alert-error");

    if (dataResponse === "success") {
      setTimeout(() => {
        alert.classList.remove("d-none");
      }, 3000);
      setTimeout(() => {
        window.location.href = "index.php";
      }, 6000);
    }else if (dataResponse === 'error') {
      setTimeout(() => {
        alertError.classList.remove("d-none");
      }, 3000);
    }
  } catch (error) {
    console.error(error);
  }
};

const fetchNoneData = async (url) =>{
  try {
    const response = await fetch(url);

    if (!response.ok) {
      throw new Error("Could not fetch resource");
    }
    const dataResponse = await response.text();
    return dataResponse;

  }catch(error){
    console.log(error);
  }
}

const startCompetition = async () =>{
  let response = await fetchNoneData("../function/Process.php?start");
  console.log(response);
  if (response === 'success') {
    window.location.href = "index.php"
  }
}

const logout = async () =>{
  let response = await fetchNoneData("../function/Process.php?logoutAccount=shinratensiegomugomunobabyshark");
  let alertModal = document.getElementById("alert-modal");
  let alertMode = alertModal.querySelector(".card");
  console.log(response);
  if (response === 'success') {
    alertModal.classList.remove("d-none");
    alertMode.classList.remove("d-none");
    setTimeout(() => {
      window.location.href = "index.php"
    }, 3000);

  }
}

if (submitForm) {
  submitForm.onsubmit = (e) => {
    const form = document.forms["add-question"];
    e.preventDefault();
    addQuestion(form);
  };
}

if (indexDOM) {
  let alertModal = document.getElementById("alert-modal");
  let alertMode = alertModal.querySelectorAll(".card");
  let questionNumber = document.getElementById("question-number");
  let questionDiv = document.getElementById("question");
  let choices = document.getElementById("choices");

  indexDOM.onload = () => {

    async function getResponseDataFromDb(){
      const dataResponse = await getDataFromDbGet("./function/Process.php?questions");

      if(dataResponse[0].status === 1) {
        questionDiv.classList.add("pt-5")
        questionDiv.innerHTML = "Competition is yet to start. Please for the admin to start the competition";
      }else{

      for (let i = 0; i < dataResponse.length; i++) {

        const dataObject = {
          id: dataResponse[i].question_id,
          question: dataResponse[i].question,
          answer: dataResponse[i].answer,
          choices: [
            dataResponse[i].A,
            dataResponse[i].B,
            dataResponse[i].C,
            dataResponse[i].D,
          ],
          status: dataResponse[i].status,
          activation: dataResponse[i].activation,
          category: dataResponse[i].category
        }


        if (dataObject.status === 3 && dataObject.activation === 1) {
          questionNumber.innerHTML = dataResponse[i]['question_id']
          questionDiv.innerHTML = dataResponse[i]['question']

          document.getElementById("time-div").classList.remove("d-none")

          let interval = setInterval(() => {
            time -= 4;
            if (time <= 0) {
              clearInterval(interval); // Stop the timer when time reaches zero or less
              timer.innerHTML = "Time's up!";
              let buttons = document.querySelectorAll("button");
                buttons.forEach(button => {
                button.classList.add("disabled")
                button.setAttribute("disabled","true")
                
                if (dataObject.category != 2) {
                  disableAccount()
                  alertModal.classList.remove("d-none")
                  alertMode[2].classList.remove("d-none")
                }
              })
            } else {
              timer.innerHTML = time + "ms";
            }
            }, 1);

         
          
          for (let j = 0; j < dataObject.choices.length; j++) {
            let col = document.createElement("div");
          col.setAttribute("class", "col-6");
              col.innerHTML = `
              <button class="w-100"><span>${letters[j]}</span> ${dataObject.choices[j]} <i class="bx bx-check-circle"></i></button>
          `;
          choices.appendChild(col);

          document.querySelectorAll("button")[j].onclick = () => {
            let correctAnswer;
            let code;
            let buttons = document.querySelectorAll("button");
            for (let y = 0; y < buttons.length; y++) {
              if (y === j) {
                buttons[j].classList.add("active");
              } else {
                buttons[y].classList.add("disabled");
              }
            }
            clearInterval(interval);
            
            if (dataObject.answer === j) {
              alertModal.classList.remove("d-none");
              alertMode[0].classList.remove("d-none");
              correctAnswer = 'correct';
              code = 1;
            } else {
              alertModal.classList.remove("d-none");
              alertMode[1].classList.remove("d-none");
              correctAnswer = 'wrong';
              if (dataObject.category != 2) {
                disableAccount()
              }
              code = null;
            }
            
            let answerData = {
              answer: dataObject.choices[j],
              question_id: dataObject.id,
              time: time,
              correct: correctAnswer,
              code: code
            };


            console.log(answerData);

            addAnswer(answerData);
          };

          }
          
        }
      }
    }
    }
    getResponseDataFromDb()

    
   setInterval(() => {
      getNewQuestion()
    }, 1500);

    };
  
}

if (signupForm) {
  signupForm.onsubmit = (e) => {
    e.preventDefault();
    let errors = document.querySelectorAll(".errors");
    let loadingSignup = document.getElementById("loading-signup");
    let alert = document.getElementById("alert-success");
    const datas = {
      fname: signupForm["fname"].value,
      lname: signupForm["lname"].value,
      mname: signupForm["mname"].value,
      level: signupForm["level"].value,
    };

    if (datas[0] === "") {
      errors[0].classList.remove("d-none");
      errors[0].innerHTML = "Please fill firstname";
    } else {
      errors[0].classList.add("d-none");
    }

    if (datas[1] === "") {
      errors[1].classList.remove("d-none");
      errors[1].innerHTML = "Please fill lastname";
    } else {
      errors[1].classList.add("d-none");
    }

    if (datas[0] !== "" && datas[1] !== "") {
      signup(datas);
      signupForm["button"].classList.add("disabled");
      loadingSignup.classList.remove("d-none");
      setTimeout(() => {
        loadingSignup.classList.add("d-none");
        alert.classList.remove("d-none");
      }, 3000);
    }
  };
}

if (loginForm) {
  loginForm.onsubmit = (e) => {
    e.preventDefault();
    let errors = document.querySelectorAll(".errors");
    let loadingSignup = document.getElementById("loading-signup");
    
    const datas = {
      uname: loginForm["uname"].value,
      password: loginForm["password"].value,
      login: true
    };

    if (datas.uname == '') {
      errors[0].classList.remove("d-none");
      errors[0].innerHTML = "Please fill username";
    } else {
      errors[0].classList.add("d-none");
    }

    if (datas.password == '') {
      errors[1].classList.remove("d-none");
      errors[1].innerHTML = "Please fill password";
    } else {
      errors[1].classList.add("d-none");
    }

    if (datas.uname !== "" && datas.password !== "") {
      login(datas);
      loginForm["button"].classList.add("disabled");
      loadingSignup.classList.remove("d-none");
      setTimeout(() => {
        loadingSignup.classList.add("d-none");
      }, 3000);
    }
  };
}

if (adminDOM) {
    adminDOM.onload = () => {
      activateTooltip();
      getContestantsData();
      countMaxQuestion()
      // getQuestions();
      getCurrentQuestion()
      getQuestionFromDB();
      const interval = setInterval(() => {
        time -= 4;
        if (time <= 0) {
          clearInterval(interval); // Stop the timer when time reaches zero or less
          timer.innerHTML = "Time's up!";
          nextBtn.classList.remove("d-none");
        } else {
          timer.innerHTML = time + "ms";
        }
      }, 1);

      // let interval = setInterval(timerMs, 1);
    };
}

if (startBtn) {
  startBtn.onclick = () =>{
    startCompetition()
  }
}

if (logOutBtn) {
  logOutBtn.onclick = async (e) => {
    e.preventDefault();
    logout();
  }
}