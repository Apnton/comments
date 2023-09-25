import axios from 'axios';
import {defineStore} from 'pinia';

export const useCommentStore = defineStore('commentStore', {
    state: () => ({
        comments: [],
        dialogVisible: false,
        form: {
            name: '',
            email: '',
            message: '',
            parent_id: null,
            image: {},
            file: null
        },
        params: {
            order_by: 'comments.created_at',
            direction: 'desc',
            limit: 25,
            page: 1
        }
    }),

    actions: {
        getCommentsWithParams(params) {
            axios.get('api/comments', {
                params: params
            })
                .then(res => {
                    this.$state.comments = res.data.items
                }).catch(err => {
                console.log(err);
            })
        },

        storeComment(data) {
            axios.post('api/comments', data)
                .then(res => {
                    console.log(res);
                    this.$state.form = {
                        name: '',
                        email: '',
                        message: '',
                        parent_id: null,
                        file: null
                    }

                }).catch(err => {
                console.log(err);
            })
        },

         uploadImage(image) {
            return new Promise((resolve, reject) => {
                axios.post('api/comments/uploadImage', image)
                    .then((response) => {
                        resolve(response.data.url);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
    }
})
