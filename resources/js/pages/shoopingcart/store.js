import { reactive } from 'vue'

export const store = reactive({
  isiProduk: [],
  banyakProduk: 0, 
  increment(item) {
    this.isiProduk.push(item)
  }
})