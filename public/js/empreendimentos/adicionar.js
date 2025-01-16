const formItems = document.getElementsByClassName("form-item");
const button = document.getElementsByClassName("btn-step");
const steps = document.getElementsByClassName("step");

let currentFormItem = 0;
formItems[currentFormItem].style.display = "block";

if (currentFormItem == 0) {
  button[0].style.display = "none";
  steps[0].style.backgroundColor = "#252b3b";
}

// Next Button
button[1].addEventListener("click", () => {
  currentFormItem++;
  const prevFormItem = currentFormItem - 1;

  if (currentFormItem > 0 && currentFormItem < 4) {
    button[0].style.display = "inline-block";
    formItems[currentFormItem].style.display = "block";
    formItems[prevFormItem].style.display = "none";
    steps[currentFormItem].style.backgroundColor = "#252b3b";

    if (currentFormItem == 3) {
      button[1].innerHTML = "Enviar";
    }
  } else {



    if (currentFormItem > 3) {

          $.ajax({
            method: 'GET',
            url: 'salvar',
            data: $('.form_add_emp').serialize(),

            dataType: 'json',
            beforeSend: function () {

            },
            success: function (data) {

              if(data.status == true){
                window.location.href = '/admin/empreendimentos';
                const Toast = Swal.mixin({
                  toast: true,
                  position: "top-end",
                  showConfirmButton: false,
                  timer: 8000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                  }
                });
  
                Toast.fire({
                  icon: "success",
                  title: data.message
                });
  
              }else{

                const Toast = Swal.mixin({
                  toast: true,
                  position: "top-end",
                  showConfirmButton: false,
                  timer: 8000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                  }
                });
  
                Toast.fire({
                  icon: "error",
                  title: data.message
                });
  
              }


            },
            error: function () {

            },
            complete: function () {

            }

          });


    }
  }
});

// Prev Button
button[0].addEventListener("click", () => {
  if (currentFormItem > 0) {
    currentFormItem--;
    const nextFormItem = currentFormItem + 1;
    formItems[currentFormItem].style.display = "block";
    formItems[nextFormItem].style.display = "none";
    steps[nextFormItem].style.backgroundColor = "#cfd2d4";

    if (currentFormItem == 0) {
      button[0].style.display = "none";
    }

    if (currentFormItem < 3) {
      button[1].innerHTML = "Avançar";
    }
  }
});
