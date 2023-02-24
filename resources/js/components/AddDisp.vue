<template>
    <div class="container">
        <form>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Descrição:</label>
                <textarea class="form-control" id="desc"></textarea>
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Valor:</label>
                <input @change="format" type="text" class="form-control" id="val">
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Data:</label>
                <input type="date" class="form-control" id="data">
            </div>
        </form>
        <button type="button" class="btn btn-primary" @click="add">Adicionar</button>
    </div>
</template>
<script>
export default {
    data(){
        return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    methods: {
        async add(){
            const dados = {
                desc: document.getElementById('desc').value,
                val: document.getElementById('val').value,
                date: document.getElementById('data').value
            }

            let res = await fetch("despesas", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf
                },
                body: JSON.stringify(dados),
            })
            if(res.status == 200){
                window.location.href = '/'
            }

            console.log(res);
        },

        async format(e){
            var formt= new Intl.NumberFormat('pt-BR',{style:"currency",currency:"BRL"})
            console.log(e)
            let el = e.target;

            el.value = parseFloat(el.value.replace('R$','').replace('.','').replace(',','.'))
            this.vl = el.value; 
            return el.value = formt.format(el.value);
        }
    }
}
</script>