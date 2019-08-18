<template>
    <!-- ダイアログベースデザイン -->
    <transition name="modal">
        <div class="modal modal-mask"  @click.self="$emit('close')">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <button class="btn pull-right closed"  @click="$emit('close')" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                    <div class="modal-header">
                        <slot name="header">
                            default header
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            default Body
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "Modal"
    }
</script>

<style scoped>

</style>
