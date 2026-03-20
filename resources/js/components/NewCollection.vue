<template>
<section id="billboard" class="bg-light py-5">
    <div class="container">
      <div class="row justify-content-center">
        <h1 class="section-title text-center mt-4" data-aos="fade-up">New Collections</h1>
        <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe voluptas ut dolorum consequuntur, adipisci
            repellat! Eveniet commodi voluptatem voluptate, eum minima, in suscipit explicabo voluptatibus harum,
            quibusdam ex repellat eaque!</p>
        </div>
      </div>
      <div class="row">
        <div class="swiper main-swiper py-4" data-aos="fade-up" data-aos-delay="600">
          <div class="swiper-wrapper d-flex border-animation-left">
            <div class="swiper-slide"  v-for="value in collection" :key="value.id">
              <div class="banner-item image-zoom-effect " >
                <div class="image-holder">
                  <a :href="'/product/'+value.id  ">
                    <img :src="value.image" alt="product" class="img-fluid">
                  </a>
                </div>
                <div class="banner-content py-4">
                  <h5 class="element-title text-uppercase">
                    <a href="value.id" class="item-anchor">{{ value.name }}</a>
                  </h5>
                  <p>{{ value.description }}</p>
                  <div class="btn-left">
                    <a href="#" class="btn-link fs-6 text-uppercase item-anchor text-decoration-none">Discover Now</a>
                  </div>
                </div>
              </div>
            </div>
         
          </div>
          <div class="swiper-pagination"></div>
        </div>
        <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
            <use xlink:href="#arrow-left"></use>
          </svg></div>
        <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
            <use xlink:href="#arrow-right"></use>
          </svg></div>
      </div>
    </div>
  </section>
</template>
<script>
import axios  from 'axios';
 export default {
    
    data(){        
        return {
            collection:[]
        }
    },
    mounted(){
        this.getCollection();
    },
    methods:{
        getCollection(){
            axios.get('get-collection').then(response=>{this.collection = response.data})
        }
    }
 }
</script>