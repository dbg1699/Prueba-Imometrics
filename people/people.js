document.querySelector('#btn').addEventListener('click', traerDatos);

/*Muestra los datos*/
function traerDatos(){

    const HTTP =new XMLHttpRequest();
    HTTP.open('GET', 'people.json', true)

    HTTP.send();
    HTTP.onreadystatechange = function(){
        if(this.readyState==4 && this.status== 200){
            console.log(this.responseText);

            let datosPersona = JSON.parse(this.responseText);
            let answer = document.querySelector('#answer');
            answer.innerHTML = '';

            

            for(let item of datosPersona.people){

                /*fecha formato dd-mm-aaaa*/
                let fechaActual= item.birthDate;
                let dia= fechaActual.split('-');
                let organizedDate= [dia[1], dia[2], dia[0]];
                let nuevaFecha = organizedDate.join('-');


                answer.innerHTML += `
                <tr>
					<td>${item.firstName}</td>
					<td>${item.lastName}</td>
					<td>${nuevaFecha}</td>
                    <td>${item.birthDate}</td>
                    <td>${item.age}</td>
                </tr>
                `
            }            
        }
    }
}


    

