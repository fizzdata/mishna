<template>
<Head>
  <title>Mishna App</title>
  <meta name="description" content="Mishna App by FizzDate">
</Head>

  <div class="min-h-screen bg-gradient-to-b from-blue-50 to-indigo-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md py-4">
      <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="flex items-center">
          <div class="bg-primary w-10 h-10 rounded-full flex items-center justify-center mr-3">
            <i class="fas fa-book text-white text-xl"></i>
          </div>
          <h1 class="text-2xl font-bold text-primary">לימוד משניות</h1>
        </div>
        <div>
          <Link href="/dashboard" class="btn-primary text-white py-2 px-6 rounded-full font-medium text-lg">
            מיין קאנטע
          </Link>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-pattern py-16 relative overflow-hidden">
      <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
          <i class="fas fa-book-open talmud-icon" style="top: -50px; left: 20%;"></i>
          <i class="fas fa-star-of-david talmud-icon" style="bottom: -50px; right: 25%;"></i>
          
          <h1 class="text-4xl md:text-6xl font-bold mb-6 text-dark">
            <span class="text-primary">לימוד משניות</span> פאַר די גאַנצע משפחה
          </h1>
          
          <p class="text-xl md:text-2xl mb-10 text-gray-700 leading-relaxed">
            די עפפ וועט אייך העלפן אָרגאַניזירן די לימוד פון משניות אין אַ גרופע, צוטיילן פרקים צווישן משפּחה מיטגלידער און האָבן אַ קלאָר איבערבליק פון דעם פארשריט.
          </p>
          
          <div class="flex flex-wrap justify-center gap-4">
            <Link href="/register" class="btn-primary text-white py-3 px-8 rounded-full font-medium text-lg">
              שאפט א קאנטע<i class="ml-2 fas fa-user-plus"></i>
            </Link>
            <a href="#features" class="bg-white text-primary border-2 border-primary py-3 px-8 rounded-full font-medium text-lg">
              ווייז מער <i class="ml-2 fas fa-arrow-down"></i>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-white">
      <div class="container mx-auto px-4">
        <div class="text-center mb-16">
          <h2 class="text-3xl md:text-4xl font-bold mb-4">ווי אַרבעט די עפפ</h2>
          <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            מיר שאַפן אַ פּשוט'ן און עפעקטיוון וועג צו אָרגאַניזירן די לימוד פון משניות אין אַ משפּחה אָדער גרופּע
          </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-5xl mx-auto">
          <!-- Feature 1 -->
          <div class="bg-light p-8 rounded-2xl card-hover text-center">
            <div class="feature-icon">
              <i class="fas fa-users text-white text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold mb-3">שאַפן אַ משפחה גרופע</h3>
            <p class="text-gray-600">
              אָרגאַניזירט אַ גרופע פון לערנערס. יעדער משפחה מיטגליד קען זיך צייכן און אויסקלייבן פרקים.
            </p>
          </div>
          
          <!-- Feature 2 -->
          <div class="bg-light p-8 rounded-2xl card-hover text-center">
            <div class="feature-icon">
              <i class="fas fa-tasks text-white text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold mb-3">צוטיילן פרקים</h3>
            <p class="text-gray-600">
              אויסקלייבן מסכתות און פרקים, צוטיילן זיי צווישן די משפּחה מיטגלידער מיט אַ קליק.
            </p>
          </div>
          
          <!-- Feature 3 -->
          <div class="bg-light p-8 rounded-2xl card-hover text-center">
            <div class="feature-icon">
              <i class="fas fa-chart-line text-white text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold mb-3">פאָלגן דעם פראגרעס</h3>
            <p class="text-gray-600">
              האָבן אַ קלאָר איבערבליק פון וועלכע פרקים זענען שוין געלערנט און וועלכע זענען נאָך צו לערנען.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-16 bg-gradient-to-br from-blue-50 to-indigo-50">
      <div class="container mx-auto px-4">
        <div class="text-center mb-16">
          <h2 class="text-3xl md:text-4xl font-bold mb-4">די סטעפּן צו אָנהייבן</h2>
          <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            פאָלג די פּשוט'ע סטעפּן צו אָרגאַניזירן די לימוד פון משניות אין אייער משפּחה
          </p>
        </div>
        
        <div class="max-w-4xl mx-auto">
          <div class="flex flex-col md:flex-row items-center mb-16">
            <div class="md:w-2/5 mb-8 md:mb-0 flex justify-center">
              <div class="bg-white p-6 rounded-2xl shadow-lg w-64 h-64 flex items-center justify-center">
                <div class="text-6xl font-bold text-primary bg-blue-100 w-24 h-24 rounded-full flex items-center justify-center">1</div>
              </div>
            </div>
            <div class="md:w-3/5 text-center md:text-right">
              <h3 class="text-2xl font-bold mb-4">רעגיסטירט אַ משפחה קאָנטע</h3>
              <p class="text-gray-600 text-lg leading-relaxed">
                צייכן אייך אַן מיט אייער נעמען, אימעיל און טעלעפאָן נומער און לע"נ און ביז ווען מ'דארף עס האבן געענדיגט. איר וועט באַקומען אַ לינק צו צוגרייטן די לימוד פאַר אייער משפּחה.
              </p>
            </div>
          </div>
          
          <div class="flex flex-col md:flex-row-reverse items-center mb-16">
            <div class="md:w-2/5 mb-8 md:mb-0 flex justify-center">
              <div class="bg-white p-6 rounded-2xl shadow-lg w-64 h-64 flex items-center justify-center">
                <div class="text-6xl font-bold text-primary bg-blue-100 w-24 h-24 rounded-full flex items-center justify-center">2</div>
              </div>
            </div>
            <div class="md:w-3/5 text-center md:text-left">
              <h3 class="text-2xl font-bold mb-4">לאַדן משפחה מיטגלידער</h3>
              <p class="text-gray-600 text-lg leading-relaxed">
                שיקן די לינק צו אייערע משפּחה מיטגלידער און פרענדס. יעדער וואָס וויל קען זיך איינגעבן צו די גרופּע און אויסקלייבן פרקים.
              </p>
            </div>
          </div>
          
          <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-2/5 mb-8 md:mb-0 flex justify-center">
              <div class="bg-white p-6 rounded-2xl shadow-lg w-64 h-64 flex items-center justify-center">
                <div class="text-6xl font-bold text-primary bg-blue-100 w-24 h-24 rounded-full flex items-center justify-center">3</div>
              </div>
            </div>
            <div class="md:w-3/5 text-center md:text-right">
              <h3 class="text-2xl font-bold mb-4">אָנהייבן צו לערנען</h3>
              <p class="text-gray-600 text-lg leading-relaxed">
                אַלע מיטגלידער קענען איצט אויסקלייבן פרקים, זען וואָס שוין איז געלערנט געוואָרן און האָבן אַ קלאָר איבערבליק פֿון דעם פארשריט.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4">
        <div class="text-center mb-16">
          <h2 class="text-3xl md:text-4xl font-bold mb-4">וואָס זאָגן אונדזערע ניצערס</h2>
          <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            די משפחות וואָס ניצן שוין אונדזער עפפ פאַר לימוד פון משניות
          </p>
        </div>
        
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
          <!-- Testimonial 1 -->
          <div class="bg-light p-8 rounded-2xl card-hover">
            <div class="flex items-center mb-4">
              <div class="w-16 h-16 rounded-full bg-primary flex items-center justify-center text-white text-2xl font-bold mr-4">ח</div>
              <div>
                <h4 class="text-xl font-bold">חיים לוי</h4>
                <p class="text-gray-500"></p>
              </div>
            </div>
            <p class="text-gray-600 italic">
              "מיר האָבן שוין געוואָלט לערנען משניות מיט דער גאַנצער משפּחה אָבער עס איז געווען שווער צו אָרגאַניזירן. די אפפליקאציע האט אונדז געמאכט דאָס אַזוי פּשוט! יעצט קען יעדער אויסקלייבן זיינע פרקים און מיר זען דעם פארשריט."
            </p>
          </div>
          
          <!-- Testimonial 2 -->
          <div class="bg-light p-8 rounded-2xl card-hover">
            <div class="flex items-center mb-4">
              <div class="w-16 h-16 rounded-full bg-primary flex items-center justify-center text-white text-2xl font-bold mr-4">ש</div>
              <div>
                <h4 class="text-xl font-bold">שמחה כהן</h4>
                <p class="text-gray-500"></p>
              </div>
            </div>
            <p class="text-gray-600 italic">
              "איך בין אַזוי דאַנקבאַר פאַר דער עפפ! מיט דעם קען איך צוטיילן די פרקים צווישן מיינע קינדער און אייניקלעך. יעדער  ווייסט וואָס ער דאַרף לערנען, און מיר קענען זען דעם גאַנצן סדר."
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16" style="background: linear-gradient(to right, #1d4ed8, #4f46e5);">
  <div class="container mx-auto px-4 text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">גרייט אָנצוהייבן צו לערנען מיט אייער משפחה?</h2>
    <p class="text-xl text-blue-100 mb-10 max-w-2xl mx-auto">
      שאַפט אַ משפחה קאָנטע איצט און הייבט אן צו אָרגאַניזירן די לימוד פון משניות
    </p>
    <Link href="/register" class="bg-white text-primary py-4 px-12 rounded-full font-bold text-lg inline-block hover:bg-blue-50 transition">
      שאַפט א קאָנטע <i class="ml-2 fas fa-arrow-right"></i>
    </Link>
  </div>
</section>


    <!-- Footer -->
    <footer class="bg-dark text-white py-12">
      <div class="container mx-auto px-4">
        
        
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
          <p>Mishna ©2025 - <a href="http://fizzdata.com">Product by and Securely Powered by FizzData.com</a></p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';


// Scroll animation function
const scrollToFeatures = () => {
  const featuresSection = document.getElementById('features');
  if (featuresSection) {
    featuresSection.scrollIntoView({ behavior: 'smooth' });
  }
};

onMounted(() => {
  // Add scroll animation for the features section
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-fadeInUp');
      }
    });
  }, { threshold: 0.1 });
  
  document.querySelectorAll('.card-hover').forEach(card => {
    observer.observe(card);
  });
});
</script>


<style scoped>
body {
  font-family: 'Rubik', sans-serif;
  direction: rtl;
}

.hero-pattern {
  background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="%231d4ed8" opacity="0.05"/><path d="M0 50 Q 25 25, 50 50 T 100 50" stroke="%234f46e5" stroke-width="0.5" fill="none"/></svg>');
  background-size: cover;
}

.card-hover {
  transition: all 0.3s ease;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  opacity: 0;
  transform: translateY(20px);
}

.card-hover:hover {
  transform: translateY(-5px) translateX(0);
  box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

.btn-primary {
  background: linear-gradient(to right, #1d4ed8, #4f46e5);
  transition: all 0.3s ease;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(29, 78, 216, 0.3);
}

.feature-icon {
  width: 70px;
  height: 70px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #1d4ed8 0%, #4f46e5 100%);
  border-radius: 50%;
  margin: 0 auto 20px;
}

.talmud-icon {
  position: absolute;
  opacity: 0.05;
  font-size: 15rem;
  z-index: 0;
}

.animate-fadeInUp {
  animation: fadeInUp 0.6s ease forwards;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes float {
  0% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-10px);
  }
  100% {
    transform: translateY(0px);
  }
}

/* Color definitions */
.bg-primary {
  background-color: #1d4ed8;
}

.bg-secondary {
  background-color: #4f46e5;
}

.bg-light {
  background-color: #f0f9ff;
}

.bg-dark {
  background-color: #0f172a;
}

.text-primary {
  color: #1d4ed8;
}

.text-secondary {
  color: #4f46e5;
}
</style>