<template>
  <div class="max-w-3xl mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-center mb-6">לימוד משניות</h1>
    <p class="text-center text-gray-600 mb-4">
      {{family.lel}}
    </p>

    <!-- List of Sedarim -->
    <div v-for="seder in groupedData" :key="seder.name" class="mb-4">
      <!-- Seder Header -->
      <div 
        @click="toggleSeder(seder.name)"
        class="cursor-pointer bg-blue-600 text-white p-4 rounded-lg hover:bg-blue-700 transition duration-200"
      >
        <h2 class="text-xl font-semibold flex items-center">
          {{ seder.name }}
          <span class="ml-auto transform transition-transform duration-300" :class="{'rotate-90': openSeder === seder.name}">▶</span>
        </h2>
      </div>

      <!-- Mesechtas Container -->
      <div 
        v-if="openSeder === seder.name" 
        class="mt-2 bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300"
      >
        <div v-for="mesechta in seder.mesechtas" :key="mesechta.name" class="border-b border-gray-100 last:border-0">
          <!-- Mesechta Header -->
          <div
            @click="toggleMesechta(mesechta.name)"
            class="cursor-pointer bg-blue-500 text-white p-3 hover:bg-blue-600 transition duration-200"
          >
            <h3 class="font-medium flex items-center">
              {{ mesechta.name }}
              <span class="ml-auto transform transition-transform duration-300" :class="{'rotate-90': openMesechta === mesechta.name}">▶</span>
            </h3>
          </div>

          <!-- Perakim Container -->
          <div 
            v-if="openMesechta === mesechta.name" 
            class="bg-gray-50 p-3 transition-all duration-300"
          >
            <ul class="space-y-2">
              <li 
                v-for="perek in mesechta.perakim" 
                :key="perek.mesechta_name + perek.perek"
                class="flex justify-between items-right bg-white p-3 rounded shadow-sm text-right"
              >
              <button 
                  v-if="perek.user_name === null || perek.user_name === ''"
                  @click="openModal(perek)"
                  class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition duration-200"
                >
                   ערוך
                </button>
                <div v-else class="flex items-center gap-2">
                  <span> {{ perek.user_name }} </span>
                  <span>: שם הלומד </span>

                </div>
                <div class="flex items-center gap-2">
                  <span> {{ perek.perek }}  ד'{{ perek.mesechta_name }} </span>

                </div>
                
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Perek Name Modal -->
    <div v-if="showModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-80">
        <h2 class="text-lg font-semibold mb-4">פרטי הלומד</h2>
        <input 
          v-model="modalPerek.user_name" 
          placeholder=" נאמען "
          class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-300 focus:border-transparent"
        />
        <input 
          v-model="modalPerek.phone" 
          placeholder=" טעלפון "
          class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-300 focus:border-transparent"
        />
        <div class="flex gap-3 mt-4 justify-end">
          <button 
            @click="closeModal" 
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md transition duration-200"
          >
            צוריק
          </button>
          <button 
            @click="savePerek()" 
            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-200"
          >
            פארזיכער
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      rawData: [],
      openSeder: null,
      openMesechta: null,
      showModal: false,
      modalPerek: null,
    };
  },

  props: {
    family: {
      type: Object,
      required: true,
      default: "לימוד משניות - ברוך ה' זוכים ללמוד משניות בכל יום"
    }
  },

  computed: {
    groupedData() {
      if (!this.rawData.length) return [];
      const sederMap = {};

      this.rawData.forEach((perek) => {
        if (!sederMap[perek.seder_name]) {
          sederMap[perek.seder_name] = { 
            name: perek.seder_name, 
            mesechtas: [] 
          };
        }
        
        let mesechta = sederMap[perek.seder_name].mesechtas.find(
          m => m.name === perek.mesechta_name
        );
        
        if (!mesechta) {
          mesechta = { 
            name: perek.mesechta_name, 
            perakim: [] 
          };
          sederMap[perek.seder_name].mesechtas.push(mesechta);
        }
        
        mesechta.perakim.push(perek);
      });

      return Object.values(sederMap);
    }
  },
  methods: {
    toggleSeder(sederName) {
      this.openSeder = this.openSeder === sederName ? null : sederName;
      this.openMesechta = null; // Close any open mesechta when seder changes
    },
    toggleMesechta(mesechtaName) {
      this.openMesechta = this.openMesechta === mesechtaName ? null : mesechtaName;
    },
    openModal(perek) {
      this.modalPerek = { ...perek };

      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
    savePerek() {

      console.log(this.family);

      fetch(`/api/${this.family.uid}/store`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(this.modalPerek)
      })
      const perek = this.rawData.find(
        p => p.mesechta_name === this.modalPerek.mesechta_name && 
             p.perek === this.modalPerek.perek
      );
      
      if (perek) {
        perek.user_name = this.modalPerek.user_name;
      }
      
      this.closeModal();
    },
    async fetchData() {
      try {
        const response = await fetch(`/api/${this.family.uid}/perakim`);
        this.rawData = await response.json();
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    }
  },
  created() {
    this.fetchData();
  }
};
</script>
