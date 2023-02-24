<template>
    <div>
        <div class="mb-3">
            <label for="desc" class="form-label">Descrição</label>
            <textarea :disabled="readonly" v-model="descDespesa" id="desc" class="form-control" name="" cols="30" rows="5" required></textarea>
            <div id="descricao" class="form-text">Descrição da Despesa</div>
        </div>
        <div class="mb-3">
            <label for="Valor" class="form-label">Valor</label>
            <input :disabled="readonly" @change="formt" :value="despesa.valor" type="text" class="form-control" id="Valor" required>
            <div id="vlDespesa" class="form-text">Valor da Despesa</div>
        </div>
        <div class="mb-3 row">
            <div class="col-5">
                <label class="form-check-label" for="data">Data</label>
                <input :disabled="readonly" type="date" v-model="dtDespesa" class="form-control input-sm" id="data" required>
                <div id="vlDespesa" class="form-text">Data de ocorrência da Despesa</div>
            </div>
            
        </div>
        <button v-if="!readonly" @click="edit" class="btn btn-primary">Cadastrar</button>
    </div>
</template>
<script>
export default {
    data(){
        return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            descDespesa:'',
            vlDespesa:'',
            despesa:{},
            data:'',
            valor:0,
            desc:'',
            readonly:true
        }
    },
    methods:{
        async mostrar(){
            var options = {
                Headers:{
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf
                },
                method:'GET'
            }

            let despesas = await fetch(`despesas/${this.$route.query.desp}`,options)

            despesas = await despesas.json();
            const date = new Date(despesas.data);
            this.despesa = despesas
            this.descDespesa = despesas.descricao,
            this.vlDespesa = despesas.valor,
            this.dtDespesa = date.toLocaleDateString()

        },
        async formt(e){
            var formatter= new Intl.NumberFormat('pt-BR',{style:"currency",currency:"BRL"})
            let element = e.target;

            element.value = parseFloat(element.value.replace('R$','').replace('.','').replace(',','.'))
            this.vlDespesa = element.value; 
            return element.value = formatter.format(element.value);
        },
        async edit(){

            
            let body= {
                    desc: document.getElementById('desc').value,
                    valor:this.vlDespesa,
                    date:this.dtDespesa
                };
            let headers={
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf
                };
            let result = await axios.put(`despesas/${this.despesa.id}`, body, { headers })
            console.log(result)

            if (result.status ==200) {
                window.location.href = '#/'
            }
        },
    },
    mounted(){
        if (this.$route.path =='/view') {
            this.readonly = true;
        } else {
            this.readonly = false;
        }
        this.mostrar()
    }
}
</script>