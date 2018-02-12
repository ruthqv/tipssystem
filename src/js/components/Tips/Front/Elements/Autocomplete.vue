
<template>
  <div class="search--wrap">
    <div ref="searchSync" class="search--input--wrap">
      <input v-on:keyup="searchCategories">
    </div>
    <transition name="slide-toggle">
      <div ref="suggestList" class="search--suggest" v-show="showSuggest">
           <div class="search--suggest--item" v-for="(item, idx) in datas" :key="idx" @click="handleSelect(item)">
    
            </div>
      </div>
    </transition>
  </div>
</template>
<script>
  export default {
    name: "Autocomplete",
    props: {
      datas: Array,
      input: Function,
      selected: Function,
      placeholder: String,
      showBtn: {
        type: Boolean,
        default: true
      }
    },
    data() {
      return {
        showSuggest: false,
        value: ''
      };
    },
    methods: {
      handleBlur: function(ev) {
        if (!ev.target.value) {
          this.showSuggest = false;
        }
      },
      handleInput: function(ev) {
        this.$emit('input', ev);
        if (!ev.target.value) {
          this.showSuggest = false;
        } else if (this.datas) {
          this.showSuggest = true;
        } else {
          this.showSuggest = false;
        }
      },
      handleSelect: function(item) {
        this.$emit("selected", item);
        this.value = item.value;
        this.showSuggest = false;
      },
      handleSubmit: function() {
        this.$emit('click', this.value)
      }
    },
    mounted() {
      let rect = this.$refs.searchSync.getBoundingClientRect();
      this.$refs.suggestList.style.top = rect.height + 20 + "px";
    }
  };
</script>