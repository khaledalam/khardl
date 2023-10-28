<template>
  <DefaultField
    :field="field"
    :errors="errors"
    :full-width-content="fullWidthContent"
    :key="index"
    :show-help-text="showHelpText"
  >
    <template #field>
      <div class="rounded-lg" :class="{ disabled: isReadonly }">
        <Trix
          name="trixman"
          :value="value"
          @change="handleChange"
          @file-added="handleFileAdded"
          @file-removed="handleFileRemoved"
          :class="{ 'form-input-border-error': hasError }"
          :with-files="field.withFiles"
          v-bind="field.extraAttributes"
          :disabled="isReadonly"
          class="rounded-lg"
        />
      </div>
    </template>
  </DefaultField>
</template>

<script>
import {
  FormField,
  HandlesFieldAttachments,
  HandlesValidationErrors,
} from '@/mixins'

export default {
  emits: ['field-changed'],

  mixins: [HandlesValidationErrors, HandlesFieldAttachments, FormField],

  data: () => ({ index: 0 }),

  mounted() {
    Nova.$on(this.fieldAttributeValueEventName, this.listenToValueChanges)
  },

  beforeUnmount() {
    Nova.$off(this.fieldAttributeValueEventName, this.listenToValueChanges)

    this.clearAttachments()
  },

  methods: {
    /**
     * Update the field's internal value when it's value changes
     */
    handleChange(value) {
      this.value = value

      this.$emit('field-changed')
    },

    fill(formData) {
      this.fillIfVisible(formData, this.fieldAttribute, this.value || '')

      this.fillAttachmentDraftId(formData)
    },

    /**
     * Initiate an attachement upload
     */
    handleFileAdded({ attachment }) {
      if (attachment.file) {
        const onCompleted = url => {
          return attachment.setAttributes({
            url: url,
            href: url,
          })
        }

        const onUploadProgress = progressEvent => {
          attachment.setUploadProgress(
            Math.round((progressEvent.loaded * 100) / progressEvent.total)
          )
        }

        this.uploadAttachment(attachment.file, {
          onCompleted,
          onUploadProgress,
        })
      }
    },

    handleFileRemoved({ attachment: { attachment } }) {
      this.removeAttachment(attachment.attributes.values.url)
    },

    listenToValueChanges(value) {
      this.index++
    },
  },
}
</script>
