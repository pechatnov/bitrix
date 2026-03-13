// Базовые Vue 3 компоненты-обёртки над Bootstrap-классами
// Регистрируются глобально в приложении через app.component()

window.PvComponents = {
  'pv-section': {
    inheritAttrs: false,
    props: {
      tag: { type: String, default: 'section' }
    },
    computed: {
      sectionClass() {
        const classes = { 'pv-section': true };
        const attrsClass = this.$attrs.class;
        if (attrsClass) {
          attrsClass.split(' ').forEach(c => {
            if (c) classes[c] = true;
          });
        }
        return classes;
      }
    },
    template: '<component :is="tag" :class="sectionClass"><slot /></component>'
  },

  'pv-card': {
    props: {
      tag: { type: String, default: 'div' }
    },
    template: '<component :is="tag" class="pv-card"><div class="pv-card-body"><slot /></div></component>'
  },

  'pv-button-primary': {
    props: {
      tag: { type: String, default: 'button' },
      type: { type: String, default: 'button' }
    },
    template: '<component :is="tag" :type="tag === \'button\' ? type : undefined" class="pv-btn-primary"><slot /></component>'
  },

  'pv-button-outline': {
    props: {
      tag: { type: String, default: 'button' },
      type: { type: String, default: 'button' }
    },
    template: '<component :is="tag" :type="tag === \'button\' ? type : undefined" class="pv-btn-outline"><slot /></component>'
  },

  'pv-feedback-modal': {
    data() {
      return {
        name: '',
        email: '',
        message: ''
      };
    },
    methods: {
      submit() {
        // TODO: отправка формы через API
        alert('Форма отправлена (заглушка)');
      }
    },
    template: `
      <div
        class="modal fade"
        id="pv-feedback-modal"
        tabindex="-1"
        aria-labelledby="pv-feedback-modal-label"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="pv-feedback-modal-label">Обратная связь</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
              <form @submit.prevent="submit">
                <div class="mb-3">
                  <label for="pv-modal-feedback-name" class="form-label">Имя</label>
                  <input v-model="name" type="text" class="form-control" id="pv-modal-feedback-name" placeholder="Как к вам обращаться?">
                </div>
                <div class="mb-3">
                  <label for="pv-modal-feedback-email" class="form-label">E-mail</label>
                  <input v-model="email" type="email" class="form-control" id="pv-modal-feedback-email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                  <label for="pv-modal-feedback-message" class="form-label">Сообщение</label>
                  <textarea v-model="message" class="form-control" id="pv-modal-feedback-message" rows="4" placeholder="Ваш вопрос или комментарий"></textarea>
                </div>
                <div class="modal-footer px-0 pb-0">
                  <pv-button-outline type="button" data-bs-dismiss="modal">Закрыть</pv-button-outline>
                  <pv-button-primary type="submit">Отправить</pv-button-primary>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    `
  }
};
