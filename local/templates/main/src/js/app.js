// Главная точка входа Vue 3 приложения PV
// Использует BX.Vue3 из ядра Битрикс (Битрикс 22.0+),
// с автоматическим fallback на глобальный Vue 3 (CDN)

(function () {
  /**
   * Получить объект Vue 3: сначала ищем BX.Vue3 (ядро Битрикс),
   * затем глобальный Vue (CDN).
   * @returns {object|null}
   */
  function getVue() {
    if (typeof BX !== 'undefined' && BX.Vue3 && typeof BX.Vue3.createApp === 'function') {
      return BX.Vue3;
    }
    if (typeof Vue !== 'undefined' && typeof Vue.createApp === 'function') {
      return Vue;
    }
    return null;
  }

  function initApps() {
    var VueLib = getVue();

    if (!VueLib) {
      console.error('[PV] Vue 3 не найден. Подключите ui.vue3 или добавьте Vue CDN.');
      return;
    }

    // --- Основное приложение (главная страница) ---
    var mainRoot = document.getElementById('pv-main-app');

    if (mainRoot) {
      var mainApp = VueLib.createApp({
        data: function () {
          return {
            newsFilter: {
              query: '',
              sort: 'date_desc'
            },
            newsItems: [],
            newsPagination: {
              page: 1,
              pageSize: 5,
              total: 0
            }
          };
        },
        created: function () {
          this.loadNews(1);
        },
        methods: {
          loadNews: function (page) {
            var self = this;
            page = page || 1;
            self.newsPagination.page = page;

            var params = new URLSearchParams({
              page: String(page),
              pageSize: String(self.newsPagination.pageSize),
              q: self.newsFilter.query || '',
              sort: self.newsFilter.sort || 'date_desc'
            });

            fetch('/local/api/news.php?' + params.toString(), {
              headers: { Accept: 'application/json' },
              credentials: 'same-origin'
            })
              .then(function (response) {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
              })
              .then(function (payload) {
                if (!payload || !payload.success) {
                  throw new Error(payload && payload.error ? payload.error : 'Unknown API error');
                }
                self.newsItems = payload.data.items || [];
                self.newsPagination.page = payload.data.page || page;
                self.newsPagination.pageSize = payload.data.pageSize || self.newsPagination.pageSize;
                self.newsPagination.total = payload.data.total || self.newsItems.length;
              })
              .catch(function () {
                self.newsItems = [
                  {
                    id: 1,
                    title: 'Новость-заглушка',
                    date: '2026-03-06',
                    preview: 'Произошла ошибка при загрузке новостей. Проверьте модуль pv.main или инфоблок.'
                  }
                ];
                self.newsPagination.total = self.newsItems.length;
              });
          }
        }
      });

      // Регистрируем глобальные компоненты
      if (window.PvComponents) {
        Object.keys(window.PvComponents).forEach(function (name) {
          mainApp.component(name, window.PvComponents[name]);
        });
      }

      mainApp.mount('#pv-main-app');
    }

    // --- Модальное окно обратной связи (все страницы) ---
    var feedbackRoot = document.getElementById('pv-feedback-vue-root');

    if (feedbackRoot) {
      var feedbackApp = VueLib.createApp({
        template: '<pv-feedback-modal />'
      });

      if (window.PvComponents) {
        Object.keys(window.PvComponents).forEach(function (name) {
          feedbackApp.component(name, window.PvComponents[name]);
        });
      }

      feedbackApp.mount('#pv-feedback-vue-root');
    }
  }

  // Запускаем после загрузки DOM и Битрикс-ядра
  if (typeof BX !== 'undefined' && typeof BX.ready === 'function') {
    BX.ready(initApps);
  } else {
    document.addEventListener('DOMContentLoaded', initApps);
  }
})();
