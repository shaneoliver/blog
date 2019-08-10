<template>
    <div class="row">
        <div class="col-8">
            <div class="form-group mt-2">   
                <label for="title">Title</label>
                <input ref="title" type="text" class="form-control" :class="hasError('title') ? 'is-invalid': ''" id="title" v-model="title" placeholder="Title" autofocus>
                <div class="invalid-feedback" v-if="hasError('title')">
                    {{ getError('title') }}
                </div>
            </div>
            <div class="form-group mt-2">   
                <label for="slug">Slug</label>
                <input ref="slug" type="text" class="form-control" :class="hasError('slug') ? 'is-invalid': ''" id="slug" v-model="slug" placeholder="/slug" autofocus>
                <div class="invalid-feedback" v-if="hasError('slug')">
                    {{ getError('slug') }}
                </div>
            </div>
            <div class="form-group mt-2">   
                <label for="content">Content</label>
                <textarea ref="content" type="text" class="form-control" :class="hasError('content') ? 'is-invalid': ''" id="content" v-model="content" placeholder="Article content...">{{ content }}</textarea>
                <div class="invalid-feedback" v-if="hasError('content')">
                    {{ getError('content') }}
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="mb-4">
                <button @click="publish" class="btn btn-primary">Publish</button>
                <button @click="save" class="btn btn-outline-secondary">Save</button>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Status and Visibility</h5>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="public" v-model="private">
                        <label class="custom-control-label" for="public">Article is private</label>
                    </div>
                    <div class="form-group mt-4" v-if="! private">
                        <label for="password">Password protect article?</label>
                        <input ref="password" type="text" class="form-control" id="password" aria-describedby="passwordHelp" v-model="password" placeholder="Password">
                        <small id="passwordHelp" class="form-text text-muted">Secure password that is required before viewing the article.</small>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5>Categories</h5>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5>Tags</h5>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5>Excerpt</h5>
                    <div class="form-group mt-2">
                        <textarea ref="excerpt" type="text" class="form-control" :class="hasError('excerpt') ? 'is-invalid': ''" id="excerpt" v-model="excerpt" placeholder="Article excerpt...">{{ excerpt }}</textarea>
                        <div class="invalid-feedback" v-if="hasError('excerpt')">
                            {{ getError('excerpt') }}
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
                title: '',
                content: '',
                excerpt: '',
                password: null,
                published_at: null,
                errors: {},
                private: false,
                slug: '',
            }
        },
        watch: {
            private() {
                if(! this.private) {
                    this.$nextTick(() => {
                        this.$refs.password.focus();
                    });
                }
            },
            title() {
                this.slugify(this.title);
            }
        },
        methods: {
            save() {
                this.store();
            },
            publish() {
                this.store();
            },
            store() {
                axios.post('/articles', this.$data)
                    .then(response => {
                        console.log(response.data);
                        this.errors = {};
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    })
            },
            hasError(name) {
                return this.errors.hasOwnProperty(name);
            },
            getError(name) {
                return this.errors[name][0];
            },
            slugify(string) {
                const a = 'àáäâãåăæąçćčđďèéěėëêęğǵḧìíïîįłḿǹńňñòóöôœøṕŕřßşśšșťțùúüûǘůűūųẃẍÿýźžż·/_,:;'
                const b = 'aaaaaaaaacccddeeeeeeegghiiiiilmnnnnooooooprrsssssttuuuuuuuuuwxyyzzz------'
                const p = new RegExp(a.split('').join('|'), 'g')

                this.slug = string.toString().toLowerCase()
                    .replace(/\s+/g, '-') // Replace spaces with -
                    .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
                    .replace(/&/g, '-and-') // Replace & with 'and'
                    .replace(/[^\w\-]+/g, '') // Remove all non-word characters
                    .replace(/\-\-+/g, '-') // Replace multiple - with single -
                    .replace(/^-+/, '') // Trim - from start of text
                    .replace(/-+$/, '') // Trim - from end of text
            }
        }
    }
</script>
