
  const deletebtns = document.querySelectorAll("#delete");
  deletebtns.forEach(deletebtn => {
    deletebtn.addEventListener("click",deletes)
  });
   function deletes(e) {
       e.preventDefault();
       console.log("ddsdhu");
       let id = e.target.getAttribute("data-index");
       let userid = e.target.getAttribute("data-user");
       div = e.target;
    Swal.fire({
        title:'Are you sure you want to delete',
        icon:'warning',
        showCancelButton:true,
        cancelButtonColor:'#d33',
        timer:5000
       }).then(response => {
        const isConfirmed = response.isConfirmed;
        if (isConfirmed) {
          xhr = new XMLHttpRequest();
          xhr.open('GET', 'api.php?orderid=' + id +'&userid=' + userid, true);
    
          xhr.onload = function () {
            // console.log(this.responseText);
            if (this.responseText) {
              console.log(this.responseText);
              if (this.responseText == "successfull") {
                  console.log("weew");
                let parente = div.parentNode;
                let main = parente.parentNode;
                // let main = grandParent.parent;
                console.log(main);
                main.remove(); 
                Swal.fire({
                    title:'successfully Deleted',
                    icon:'success',
                    timer:5000
                   })
              }
            }
          }
          xhr.send();
          // console.log(id);
        }
    
      })
    
   }
    //  working for copy to clipboard
    btns = document.querySelectorAll("#button");
    btns.forEach(btn => {
      btn.addEventListener("click", (e) => {
        index = e.target.getAttribute("data-index");
        input = document.querySelectorAll("#addreess")[index - 1];
        console.log(input);
        input.select();
        input.setSelectionRange(0, 9999);
        document.execCommand("copy");
        window.getSelection().removeAllRanges();
      });
    });