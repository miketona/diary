<template>
  <h1>My Diary</h1>
  <form @submit.prevent="submitEntry()">
    <textarea
      placeholder="Your diary entry"
      v-model="entryData"
      id="entryData"
    />
    <button class="waves-effect waves-light btn" type="submit">
      Post your entry
    </button>
  </form>
  <div class="entries">
    <div class="row">
      <div class="col s12 m5" v-for="entry in entries" :key="entry.id">
        <div class="card-panel teal">
          <div class="entry">
            <span class="white-text">{{ entry.entry }}</span>
            <br />
            <button
              class="waves-effect waves-light btn deleteButton"
              @click="deleteButton(entry.id)"
            >
              DELETE
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { ref } from "vue";
export default {
  name: "App",
  setup() {
    let entries = ref([]);
    const entryData = ref("");
    async function getData() {
      const { data } = await axios.get("http://localhost:3000/API/index.php");
      console.log(data);
      entries.value = data;
    }
    getData();
    function deleteButton(id) {
      //delete on screen
      entries.value.forEach((entry, i) => {
        if (entry.id === id) {
          entries.value.splice(i, 1);
        }
      });
      //delete in database
      const params = new URLSearchParams();
      params.append("id", id.toString());
      axios.post("http://localhost:3000/API/delete.php", params);
    }
    function submitEntry() {
      if (entryData.value !== "") {
        //cerate in local page
        entries.value.push({
          id: entries.value.length + 1,
          entry: entryData.value,
        });
        //create in database
        const params = new URLSearchParams();
        params.append("entry", entryData.value.toString());
        axios.post("http://localhost:3000/API/insert.php", params);
        //clear value
        entryData.value = "";
      }
    }
    return { entries, deleteButton, entryData, submitEntry };
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
