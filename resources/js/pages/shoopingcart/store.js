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
  }
})