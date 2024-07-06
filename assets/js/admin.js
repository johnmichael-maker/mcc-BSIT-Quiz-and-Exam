// $(document).ready(function(){


//     /** EXAMS
//      * add exam
//      * update exam
//      * delete exam
//      */
//     $("#add-exam").on("submit", function(e){
//         e.preventDefault();
//         $("#add-exam button").attr("disabled", "true")
//         $("#loading").removeClass("d-none")
//         $.ajax({
//             url : "../function/Process.php?add-exam",
//             type: "POST",
//             data: {
//                     section: $("#section").val(), 
//                     year_level: $("#year_level").val(), 
//                     semester: $("#semester").val(),
//                     type: $("#type").val(),
//                     category: $("#category").val(),
//                     time_limit: $("#time_limit").val(),
//                 },
//             success: function(response){
                
//                 setTimeout(function(){
//                     $("#loading").addClass("d-none");
//                     $("#loading").addClass("d-none");
//                     $("#add-exam button").removeAttr("disabled").delay(2000);
//                     $("#alert").removeClass("d-none");
                    
//                     if (response == 1) {
//                         $("#alert").removeClass("alert-danger").addClass("alert-success").text("Exam added successfully");
//                     }else if(response == 2){
//                         $("#alert").removeClass("alert-success").addClass("alert-danger").text("Exam already exist");
//                     }
//                 }, 1500)
                
//             },
//             error: function(response){
//                 console.log(response);
//             }
//         })
//     })

//     $("#edit-exam").on("submit", function(e){
//         e.preventDefault();
//         $("#edit-exam button").attr("disabled", "true")
//         $("#loading").removeClass("d-none")
//         console.log();
//         $.ajax({
//             url : "../function/Process.php?edit-exam",
//             type: "POST",
           
//             success: function(response){
                
//                 setTimeout(function(){
//                     $("#loading").addClass("d-none");
//                     $("#loading").addClass("d-none");
//                     $("#edit-exam button").removeAttr("disabled").delay(2000);
//                     $("#alert").removeClass("d-none");
                    
//                     if (response == 1) {
//                         $("#alert").removeClass("alert-danger").addClass("alert-success").text("Exam updated successfully");
//                     }else if(response == 2){
//                         $("#alert").removeClass("alert-success").addClass("alert-danger").text("Exam already exist");
//                     }
//                 }, 1500)
                
//             },
//             error: function(response){
//                 console.log(response);
//             }
//         })
//     })


// })