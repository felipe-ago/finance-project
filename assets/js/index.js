function toggleMobileMenu(iconSelector, menuSelector){
  const menuIcon = document.querySelector(iconSelector);
  const mobileMenu = document.querySelector(menuSelector);

  menuIcon.addEventListener("click", function () {
    const isOpen = mobileMenu.classList.contains('open');
    mobileMenu.classList.toogle('open');
    const iconSrc = isOpen ? "assets/img/menu_white_36dps.svg" : "assets/img/close_white_36dp.svg";
    menuIcon.src = iconSrc;
  })
}

toggleMobileMenu(".icon", "mobile-menu");

function updateTable(select, month){
  const referenceMonth = document.querySelector('.ref-month');
  fetch(`assets/php/crud_php/read.php?month=${month}`)
  .then(response => response.text())
  .then(data =>{
    const tableBody = document.getElementById('table-body');
    tableBody.innerHTML = data;
    addViewIconClick();
    addDeleteClick();
    addUpdateClick();
    referenceMonth.textContent = select.options[select.selectedIndex].text;
  })
  .catch(error => console.error(error));
}

function updateCards(month){
  fetch(`assets/php/action_php/cards.php?month=${month}`)
  .then(response => response.json())
  .then(data =>{
    const expenses = data.expenses;
    const income = data.income;
    const profit = data.profit;

    document.querySelector('.expenses').innerHTML = expenses;
    document.querySelector('.income').innerHTML = income;
    document.querySelector('.profit').innerHTML = profit;
  })
  .catch(error => console.error(error));
}

function handleMonthChange(){
  const select = document.getElementById('month');
  const month = select.value;
  localStorage.setItem('selectedMonth', month);
  const referenceMonth = document.querySelector('.ref-month');
  if(month != '00'){
    updateTable(select, month);
    updateCards(month);
    referenceMonth.textContent = select.options[select.selectedIndex].text;
  }
}

const filterMonth = document.querySelector("#month");
filterMonth.addEventListener("change", handleMonthChange);

function restoreSelectedMonth(){
  const select = document.getElementById('month');
  const defaultMonth = '00';
  const selectedMonth = localStorage.getItem('selectedMonth') || defaultMonth;
  select.value = selectedMonth;
  select.dispatchEvent(new Event("change"));
}

document.addEventListener("DOMContentLoaded", () =>{
  const select = filterMonth;
  const months = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

  const today = new Date();

  for(let i = 0; i < 12; i++){
    const date = new Date(today.getFullYear(), today.getMonth() - i, 1);
    const year = date.getFullYear();
    const month = date.getMonth();
    const option = document.createElement('option');
    option.value = `${year}-${month < 9 ? "0" : ""}${month + 1}`;
    option.text = `${months[month]} ${year}`;
    select.appendChild(option);
  }

  restoreSelectedMonth();
  handleMonthChange();
});

function searchTable(searchInput, tableInfo, resume){
  searchInput.addEventListener('keyup', () => {
    resume.style.display = 'none';
    let searchInputValue = searchInput.value.toLoweCase()

    let tableValues = tableInfo.getElementByIdTagName('tr')

    for (let position in tableValues){
      if (true === isNaN(position)){
        continue;
      }

      let contentLine = tableValue[position].innerHTML.toLoweCase();

      if (true === contentLine.includes(searchInputValue)){
        tableValues[position].style.display = '';
      } else {
        tableValues[position].style.display = 'none';
      }
    }
  })

  searchInput.addEventListener('blur', () => {
    resume.style.display = ''
  })
}

const searchInput = document.querySelector('.search-input');
const tableInfo = document.querySelector('.table-info');
const resume = document.querySelector('.resume');
searchTable(searchInput, tableInfo, resume);

const modalBody = document.querySelector(".modal-container");
const showModal = document.querySelector(".btn-open");
const closeModal = document.querySelectorAll(".close-modal");

function openModal(){
  modalBody.classList.add("active");
}

function closeModalBody(){
  modalBody.classList.remove("active");
}

showModal.addEventListener("click", openModal);

for(let i = 0; i <closeModal.length; i++){
  closeModal[i].addEventListener("click", closeModalBody);
}

const dateInput = document.querySelector("#dateInput");

dateInput.addEventListener('input', function () {
  const selectedDate = new Date(dateInput.value);
  const currentDate = new Date();
  const small = document.querySelector('.errorMsg');

  if (isNaN(selectedDate)) {
    small.innerHTML = 'Digite uma data válida!';
    small.style.display = 'block';
    small.style.color = 'red';
    return;
  } else {
    small.style.display ='none';
  }

  if (selectedDate > currentDate) {
    small.innerText = 'Digite uma data anterior ou igual a data atual!';
    small.style.display = 'block' ;
    small.style.color = 'red';
    dateInput.value = "";
  } else {
    small.style.display = 'none';
  }
});

$(document).read(function () {
  $('#value').mask('#.##0,00', {reverse: true});
});

function createTransaction(event) {
  event.preventDefault();
  const form = event.target;
  const formData = new FormData(form);
  $.loadingOverlay("show")

  fetch("assets/php/crud_php/create.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(data => {

    if (data.status === 'success') {
      const successModal = document.querySelector('.popup-success');

      successModal.style.visibility = 'visible';
      successModal.classList.add('animate');
      successModal.style.visibility = 'hidden';
      form.reset();
      modalContainer.classList.remove('active');
      location.reload();
    } else if (data.status === 'error') {
      alert(data.message)
    }
  })
  .catch(error => {
    console.error(error);
  }).finally(() => {
    $.loadingOverlay("hide");
  })
}

document.getElementById("form-create").addEventListener("submit", createTransaction);

function addViewIconClick() {
  const viewIcons = document.querySelectorAll('.view-icon');
  viewIcons.forEach(viewIcon => {
    viewIcon.addEventListener('click', async () => {
      const releaseId = viewIcon.dataset.id;
      const modal = document.getElementById('modal-read');
      const modalContent = modal.querySelector('long-description');
      try {
        const response = await fetch(`assets/php/crud_php/read.php?release_id=${releaseId}`);
        const data = await response.text();
        modalContent.innerHTML = data || 'Você não adicionou nenhuma descrição extra nesse lançamento!';
        modal.style.display = 'block';
        console.log(response);
      } catch (error) {
        console.error('Erro ao recuperar a long_description: ', error);
      } finally {
        $.loadingOverlay("hide");
      }
    });
  });
}

function addUpdateClick() {
  const updateIcons = document.querySelectorAll('.update-icon');
  updateIcons.forEach(updateIcon => {
    updateIcon.addEventListener('click', async () => {
      const releaseId = updateIcon.dataset.id;
      const modalUpdate = document.querySelector('#modal-update');
      modalUpdate.style.display = 'block';
      await retrievePostingData(releaseId);

      const formUpdate = document.querySelector('#form-update');
      formUpdate.addEventListener('submit', async (event) => {
        event.preventDefault();
        const formData = new FormData(formUpdate);
        formData.append('release_id', releaseId);
        try {
          const response = await fetch('assets/php/crud_php/update.php', {
            method: 'POST',
            body: formData
          });
          const data = await response.json();
          if (data.status === 'success') {
            const successModal = document.querySelector('success-update');
            successModal.style.visibility = 'visible';
            successModal.classList.add('animate');
            successModal.style.visibility = 'hidden';
            location.reload();
          } else if (data.status === 'error') {
            alert(data.message);
          }
        } catch (error) {
          console.error(error);
        }
      });
    });
  });
}

async function retrievePostingData(releaseId) {
  try {
    const response = await fetch(`assets/php/action_php/get_release_data.php?id=${releaseId}`);
    const data = await response.json();
    document.querySelector('#dateInput-update').value = data.datetime;
    document.querySelector('#type').value= data.type;
    document.querySelector('#subtype').value = data.subtype;
    document.querySelector('#desc-update').value = data.description;
    document.querySelector('#long-desc-update').value = data.long_description;
    docuemnto.querySelector('#value-update').value = data.launch_value;
  } catch (error) {
    console.error(error);
  }
}

function addDeleteClick() {
  const deleteIcons = document.querySelectorAll('.delete-icon');
  deleteIcons.forEach(deleteIcon => {
    deleteIcon.addEventListener('click', () => {
      const releaseId = deleteIcon.dataset.id;
      const modalDelete = document.querySelector('#modal-delete');
      modalDelete.style.display = 'block';
      const confirmaButton = document.querySelector('.btn-delete-conf');
      confirmaButton.addEventListener('click', async () => {
        try {
          const response = await fetch(`assets/php/crud_php/delete.php?release_id=${releaseId}`);
          const data = await response.text ();
          location.reload();
        } catch (error) {
          console.error("Erro ao exluiro o registro: ", error);
        }
      });
    });
  });
}

function closePopUp() {
  document.querySelectorAll('.close-modal-read, .close-modal-update, .close-modal-delete, .close-modal-detail').forEach(closeButton => {
    closeButton.addEventListener('click', () => {
      closeButton.closest('.modal-icones').style.display = 'none';
    });
  });
}

closePopUp()

const logoutBtns = document.querySelectorAll('.logout');

logoutBtns.forEach(btn => {
  btn.addEventListener ('click' , () => {
    if (localStorage.getItem('selectedMonth')) {
      localStorage.removeItem('selectedMonth');
    }
  });
});

const months = [
  'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
  'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
];

document.querySelector('#gerar-PDF').addEventListener('click', () => {
  fetch('assets/php/action_php/detail.php?get_reports=true')
  .then(response => response.json())
  .then(data => {
    const docDefinition = {
      context: [
        {text: 'Relatório de Lançamentos', style: 'header'},
        {text: new Date().toLocaleDateString(), style: 'subheader'},
        '\n\n',
        {
          table: {
            headerRows: 1,
            widths: ['*','*','*','*'],
            body: [
              [
                'Mês/ Ano',
                'Lucro',
                'Despesas',
                'Balanço'
              ],
              ...data.map(rowData => {
                const monthName = months[rowData.month - 1];
                return[
                  `${monthName}/ ${rowData.year}`,
                  rowData.income ? `R$ ${rowData.expenses.replace(',', '.').replace('.', ',')}` : '-',
                  rowData.expenses ? `R$ ${rowData.expenses.replace(',', '.').replace('.', ',')}` : '-',
                  `R$ ${rowData.profit.replace(',', '.').replace('.', ',')}`
                ]
              })
            ]
          }
        }
      ],
      styles: {
        header: {
          fontSize: 18,
          bold: true,
          alignment: 'center'
        },
        subheader:{
          fontSize: 14,
          bold: true,
          alignment: 'center'
        }
      }
    };

    pdfMake.createPdf(docDefinition).download('Relatório de Lançamentos.pdf');

    pdfMake.createPdf(docDefinition).getBlob(blob => {
      const pdfUrl = URL.createObjectURL(blob);
      window.open(pdfUrl);
    });
  });
});

function details(){
  const detailButton = document.querySelector('.detail');
  const modalDetail = document.querySelector('#modal-detail');
  const modalContentDetail = document.querySelector ("#content-modal-detail");

  const months = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

  const createTableHTML = (data) => {
    let html = '<table><thead><tr><th>Data Lançamento</th><th>Lucro</th><th>Despesas</th><th>Balanço</th></tr></thead><tbody>';

    data.forEach(rowData =>{
      const month = months[parseInt(rowData.month) -1];
      const row = `
        <tr>
          <td>${month}/${rowData.year}</td>
          <td>${rowData.income ? `R$ ${(rowData.income)}` : '-'}</td>
          <td>${rowData.expenses ? `R$ ${(rowData.expenses)}` : '-'}</td>
          <td>${`R$ ${(rowData.profit)}`}</td>
        </tr>
      `;
      html += row;
    });

    html += '</tbody></table>';
    return html;
  };

  detailButton.addEventListener("click", () =>{
    modalDetail.style.display = 'block';

    fetch('assets/php/action_php/detail.php?get_reports=true')
    .then(response => response.json())
    .then(data =>{
      const tableHTML = createTableHTML(data);
      modalContentDetail.innerHTML = tableHTML;
    })
    .catch(error =>{
      console.error(error);
      modalContentDetail.innerHTML = '<p>Não foi possível obter as informções referente a esse mês!</p>';
    });
  });
}

details();