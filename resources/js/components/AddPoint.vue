<template>
    <div class="container">
        <h2 class="text-center mt-5 mb-5">Add new point</h2>
        <form @submit.prevent="add">
            <div class="form-group row">
                <div class="col-md-4 text-md-right text-center">
                    <label class="col-form-label">Latitued</label>
                    <span class="mr-2 text-danger">*</span>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" :class="{'is-invalid': errors.lat}" placeholder="Latitued" required v-model="lat" />
                    <div class="invalid-feedback" v-if="errors.lat">{{ errors.lat[0] }}</div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4 text-md-right text-center">
                    <label class="col-form-label">Longitude</label>
                    <span class="mr-2 text-danger">*</span>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" :class="{'is-invalid': errors.lng}" placeholder="Longitude" required v-model="lng" />
                    <div class="invalid-feedback" v-if="errors.lng">{{ errors.lng[0] }}</div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4 text-md-right text-center">
                    <label class="col-form-label">Category</label>
                    <span class="mr-2 text-danger">*</span>
                </div>
                <div class="col-md-6">
                    <select class="custom-select" required v-model="category_id">
                        <option value="">Choose category</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4 text-md-right text-center">
                    <label class="col-form-label">Comment</label>
                    <span class="mr-2 text-danger invisible">*</span>
                </div>
                <div class="col-md-6">
                    <textarea class="form-control" :class="{'is-invalid': errors.comment}" rows="3" placeholder="Your comment here..." maxlength="255" v-model="comment">
                    </textarea>
                     <small class="form-text text-muted">Maximum 255 symbols</small>
                     <div class="invalid-feedback" v-if="errors.comment">{{ errors.comment[0] }}</div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary" :disabled="disabled">Add</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

    import toastr from 'toastr'

    export default {
        data() {
            return {
                comment: '',
                category_id: '',
                disabled: false,
                lat: this.$route.params.lat,
                lng: this.$route.params.lng,
                errors: {}
            }
        },
        computed: {
            categories() {
                return this.$store.state.categories
            }
        },
        methods: {
            add() {
                let data = {
                    lat: this.lat,
                    lng: this.lng,
                    category_id: this.category_id
                }
                if (this.comment.length) {
                    data.comment = this.comment
                }
                this.disabled = true
                axios.post('/point', data)
                .then(r => {
                    toastr.success('New point added successfully')
                    this.$store.commit('addPoint', r.data)
                    this.errors = {}
                    this.comment = ''
                    this.category_id = ''
                    this.lat = ''
                    this.lng = ''
                })
                .catch(e => {
                    if (e.response && e.response.data) {
                        this.errors = e.response.data.errors
                        return
                    }
                    toastr.warning('We\'re sorry, something went wrong with points, try later')
                })
                .finally(() => {
                    this.disabled = false
                })
            }
        }
    }
</script>
