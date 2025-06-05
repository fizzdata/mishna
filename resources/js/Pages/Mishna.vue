<template>
  <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6">
    <!-- Notification System -->
    <div v-if="notification.show" class="fixed top-4 right-4 p-4 rounded-md text-white shadow-lg z-50 transition-all duration-300"
         :class="notification.type === 'success' ? 'bg-green-500' : 'bg-red-500'">
      {{ notification.message }}
    </div>
    
    <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
      <!-- Header -->
      <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-center">
        <h1 class="text-2xl font-bold text-white mb-2">לימוד משניות</h1>
        <p class="text-blue-100">{{ family.lel || "ברוך ה' זוכים ללמוד משניות בכל יום" }}</p>
      </div>
      
      <!-- Bulk Controls -->
      <div v-if="selectedPerakim.length > 0" class="bg-indigo-50 p-4 border-b border-indigo-100">
        <div class="flex flex-wrap items-center justify-between">
          <div class="text-indigo-800 font-medium">
            <span class="mr-2">נבחרו:</span>
            <span class="bg-indigo-500 text-white px-2 py-1 rounded-full text-sm">{{ selectedPerakim.length }} פרקים</span>
          </div>
          <div class="flex space-x-2 mt-2 sm:mt-0">
            <button @click="deselectAll" class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded-md text-gray-700 transition">
              בטל בחירה
            </button>
            <button @click="openBulkModal" class="px-3 py-1 bg-indigo-600 hover:bg-indigo-700 rounded-md text-white transition flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
              עדכן נבחרים
            </button>
          </div>
        </div>
      </div>
      
      <!-- Loading Indicator -->
      <div v-if="loading" class="p-8 text-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600 mx-auto"></div>
        <p class="mt-4 text-gray-600">טוען נתונים...</p>
      </div>
      
      <!-- Sedarim List -->
      <div v-else class="divide-y divide-gray-100">
        <div v-for="seder in groupedData" :key="seder.name" class="p-4">
          <!-- Seder Header -->
          <div 
            @click="toggleSeder(seder.name)"
            class="cursor-pointer flex items-center justify-between py-3"
          >
            <h2 class="text-xl font-bold text-gray-800">
              {{ seder.name }}
            </h2>
            <div class="flex items-center">
              <span class="mr-3 text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded">
                {{ seder.mesechtas.length }} מסכתות
              </span>
              <span class="transform transition-transform duration-300 text-gray-500" 
                    :class="{'rotate-90': openSeder === seder.name}">
                ▼
              </span>
            </div>
          </div>
          
          <!-- Mesechtas Container -->
          <div v-if="openSeder === seder.name" class="ml-4 mt-2 border-l-2 border-gray-200 pl-4">
            <div v-for="mesechta in seder.mesechtas" :key="mesechta.name" class="mb-6">
              <!-- Mesechta Header -->
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                  <!-- <input 
                    type="checkbox" 
                    :checked="isMesechtaSelected(mesechta)"
                    @change="toggleMesechtaSelection(mesechta)"
                    :disabled="isMesechtaFullyBooked(mesechta)" 
                    class="h-4 w-4 text-indigo-600 rounded focus:ring-indigo-500"
                  > -->
                  <h3 
                    @click="toggleMesechta(mesechta.name)"
                    class="ml-2 cursor-pointer text-lg font-semibold text-gray-700 hover:text-indigo-600"
                  >
                    {{ mesechta.name }}

                                  <span class="ml-2 text-xs font-normal bg-gray-100 px-2 py-1 rounded-full">
                      <span v-if="mesechtaSummary(mesechta).taken > 0">
                        {{ mesechtaSummary(mesechta).taken }}/{{ mesechta.perakim.length }} Taken,
                        לומדים: {{ mesechtaSummary(mesechta).learners.join(', ') }}
                      </span>
                      <span v-else>
                        {{ mesechta.perakim.length }} Available
                      </span>
                    </span>

                  </h3>
                </div>
                <div class="flex items-center">
                  <span class="mr-3 text-sm text-gray-500">
                    {{ mesechta.perakim.length }} פרקים
                  </span>
                  <span 
                    class="text-gray-500 transform transition-transform duration-300"
                    :class="{'rotate-90': openMesechta === mesechta.name}"
                  >
                    ▼
                  </span>
                </div>
              </div>
              
              <!-- Perakim Container -->
              <div v-if="openMesechta === mesechta.name" class="ml-6 border-l-2 border-gray-100 pl-4">
                <div class="mb-3 flex space-x-2">
                  <button @click="selectAllInMesechta(mesechta)" class="text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 rounded">
                    קלויב אלע
                  </button>
                  <button @click="deselectAllInMesechta(mesechta)" class="text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 rounded">
                    לאזט אפ אלע
                  </button>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <div 
                    v-for="perek in mesechta.perakim" 
                    :key="perek.id"
                    @click="!perek.user_name && togglePerekSelection(perek.id)"
                    class="cursor-pointer p-3 rounded-lg border transition-all"
                    :class="{
                      'border-gray-200 hover:border-indigo-300': !perek.user_name && !isPerekSelected(perek.id),
                      'border-indigo-300 bg-indigo-50': isPerekSelected(perek.id),
                      'bg-green-50 border-green-200': perek.user_name,
                      'cursor-not-allowed opacity-75': perek.user_name  // Add disabled styling
                    }"
                  >
                    <div class="flex justify-between items-center">
                      <div class="flex items-center">
                        
                        <span class="ml-2 font-medium text-gray-700">
                          {{ perek.perek }}
                        </span>
                      </div>
                      <span v-if="perek.user_name" class="text-sm text-green-700 bg-green-100 px-2 py-1 rounded-full">
                        {{ perek.user_name }}
                      </span>
                      <input 
                          v-if="!perek.user_name"
                            type="checkbox" 
                            :checked="isPerekSelected(perek.id)"
                            class="h-4 w-4 text-indigo-600 rounded focus:ring-indigo-500"
                            @click.stop
                        >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Bulk Update Modal -->
    <div v-if="showBulkModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-xl shadow-xl w-full max-w-md">
        <div class="p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-4 text-center">Enter your details</h2>
          
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1 text-right">שם הלומד</label>
              <input 
                v-model="bulkData.user_name" 
                placeholder="שם הלומד"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-right"
              >
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1 text-right"> טלפון</label>
              <input 
                v-model="bulkData.phone" 
                placeholder="טלפון"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-right"
              >
            </div>
            
            <div class="pt-4 flex justify-end space-x-3">
              <button 
                @click="closeBulkModal" 
                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-gray-800 font-medium transition"
              >
                cancel
              </button>
              <button 
                @click="saveBulkPerakim" 
                :disabled="saving"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-white font-medium transition flex items-center disabled:opacity-50"
              >
                <span v-if="saving" class="flex items-center">
                  <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  save...
                </span>
                <span v-else class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                  </svg>
                  Submit
                </span>
              </button>
            </div>
          </div>
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
      loading: true,
      saving: false,
      
      // Notification system
      notification: {
        show: false,
        message: '',
        type: '' // 'success' or 'error'
      },
      
      // Bulk selection system
      selectedPerakim: [], // Stores IDs of selected perakim
      showBulkModal: false,
      bulkData: {
        user_name: '',
        phone: ''
      }
    };
  },

  props: {
    family: {
      type: Object,
      required: true
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
      this.openMesechta = null;
    },
    
    toggleMesechta(mesechtaName) {
      this.openMesechta = this.openMesechta === mesechtaName ? null : mesechtaName;
    },
    
    // Notification helper
    showNotification(message, type = 'success') {
      this.notification = { show: true, message, type };
      setTimeout(() => {
        this.notification.show = false;
      }, 3000);
    },
    
    // Perek selection
    togglePerekSelection(perekId) {
      const perek = this.rawData.find(p => p.id === perekId);
      if (perek.user_name) return; // Prevent selection if already taken
      
      const index = this.selectedPerakim.indexOf(perekId);
      if (index === -1) {
        this.selectedPerakim.push(perekId);
      } else {
        this.selectedPerakim.splice(index, 1);
      }
    },
    
    isPerekSelected(perekId) {
      return this.selectedPerakim.includes(perekId);
    },
    
    // Mesechta selection
    isMesechtaSelected(mesechta) {
      return mesechta.perakim.every(perek => 
        this.selectedPerakim.includes(perek.id)
      );
    },
    
    toggleMesechtaSelection(mesechta) {
       const availablePerakim = mesechta.perakim.filter(p => !p.user_name);
    
    if (availablePerakim.length === 0) return;
    
    const allSelected = availablePerakim.every(perek => 
      this.selectedPerakim.includes(perek.id)
    );

    if (allSelected) {
      // Deselect all available perakim
      availablePerakim.forEach(perek => {
        const index = this.selectedPerakim.indexOf(perek.id);
        if (index !== -1) this.selectedPerakim.splice(index, 1);
      });
    } else {
      // Select all available perakim
      availablePerakim.forEach(perek => {
        if (!this.selectedPerakim.includes(perek.id)) {
          this.selectedPerakim.push(perek.id);
        }
      });
      }
    },

      mesechtaSummary(mesechta) {
          const takenPerakim = mesechta.perakim.filter(p => p.user_name);
          const learners = [...new Set(takenPerakim.map(p => p.user_name))];
          
          return {
            taken: takenPerakim.length,
            available: mesechta.perakim.length - takenPerakim.length,
            learners: learners
          };
        },

        isMesechtaFullyBooked(mesechta) {
          return this.mesechtaSummary(mesechta).available === 0;
        },
  




    
    // Bulk selection helpers
    selectAllInMesechta(mesechta) {
      mesechta.perakim.forEach(perek => {
    if (!perek.user_name && !this.selectedPerakim.includes(perek.id)) {
      this.selectedPerakim.push(perek.id);
    }
  });
    },
    
    deselectAllInMesechta(mesechta) {
      mesechta.perakim.forEach(perek => {
        const index = this.selectedPerakim.indexOf(perek.id);
        if (index !== -1) {
          this.selectedPerakim.splice(index, 1);
        }
      });
    },
    
    deselectAll() {
      this.selectedPerakim = [];
    },
    
    openBulkModal() {
      this.bulkData = { user_name: '', phone: '' };
      this.showBulkModal = true;
    },
    
    closeBulkModal() {
      this.showBulkModal = false;
    },
    
    // Save multiple perakim
    async saveBulkPerakim() {
      if (!this.bulkData.user_name) {
        this.showNotification('אנא הזן שם לומד', 'error');
        return;
      }
      
      if (this.selectedPerakim.length === 0) {
        this.showNotification('אנא בחר לפחות פרק אחד', 'error');
        return;
      }
      
      try {
        this.saving = true;
        
        // Prepare batch update
        const updates = this.selectedPerakim.map(id => {
          return {
            id: id,
            user_name: this.bulkData.user_name,
            phone: this.bulkData.phone
          };
        });

        // Call bulk API endpoint
        const response = await fetch(`/api/${this.family.uid}/store`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(updates)
        });
        
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        
        // Update local data
        updates.forEach(update => {
          const perek = this.rawData.find(p => p.id === update.id);
          if (perek) {
            perek.user_name = update.user_name;
            perek.phone = update.phone;
          }
        });
        
        this.showNotification(`נשמרו בהצלחה ${updates.length} פרקים!`);
        this.selectedPerakim = [];
        this.closeBulkModal();
        this.fetchData();
      } catch (error) {
        console.error("Bulk save error:", error);
        this.showNotification('שגיאה בעדכון הנבחרים', 'error');
      } finally {
        this.saving = false;
      }
    },
    
    // Fetch initial data from your endpoint
    async fetchData() {
      try {
        this.loading = true;
        const response = await fetch(`/api/${this.family.uid}/perakim`);
        
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        
        this.rawData = await response.json();
      } catch (error) {
        console.error("Error fetching data:", error);
        this.showNotification('שגיאה בטעינת הנתונים', 'error');
      } finally {
        this.loading = false;
      }
    }
  },
  
  created() {
    this.fetchData();
  }
};
</script>

<style>
body {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
  background-color: #f9fafb;
  direction: rtl;
  text-align: right;
}

h1, h2, h3 {
  font-weight: 600;
}

@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}
.animate-spin {
  animation: spin 1s linear infinite;
}
</style>