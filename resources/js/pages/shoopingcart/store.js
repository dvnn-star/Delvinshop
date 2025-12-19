import { reactive } from 'vue'

export const store = reactive({
  isiProduk: [],
  banyakProduk: 0, 
  increment(item) {
    const existing = this.isiProduk.find(p => p.nama == item.nama)
    if (existing){
      existing.qty++
    }
    else{
      this.isiProduk.push(item)
    }
  },
  decrement(item){
    const index = this.isiProduk.findIndex(p => p.nama === item.nama)
    if (index !== -1){
      this.isiProduk[index].qty--
    }
    if (this.isiProduk[index].qty <= 0) {
        this.isiProduk.splice(index, 1)
      }
  }
})