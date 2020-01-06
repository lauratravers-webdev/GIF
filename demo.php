<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Vue.JS GIPHY API IN-CLASS</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
        <style media="screen">
            #giphy-results {
                display: block;
                width: 1000px;
                padding: 3rem;
                margin: 0 auto;
            }
            ul.columns {
                flex-wrap: wrap;
            }
            ul .is-full {
                display: block;
                width: 100%;
            }
            p {
                padding: 1rem 0;
            }
            a {
                display: inline-block;
                transition: 0.3s ease all;
            }
            a:hover {
                transform: scale(1.1);
            }
            button.input{
                text-align: center;
                justify-content: center;
            }
            input {
                margin: 10px;
            }
        </style>
    </head>
    <body>
        <div id="giphy-search-container">
            <giphy-results> </giphy-results>
        </div>

        <script type="text/javascript" src="https://unpkg.com/axios/dist/axios.min.js"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

        <script type="text/javascript" defer>

        var myGiphyAPIKey = 'OlZvcDgbmZarhhnaDzSkjZjJjgt3KYJN';

        //giphy search and results
        Vue.component( 'giphy-results', {
            data: function () {
                return {
                    apptitle: 'Vue.Js GIPHY API In-Class Example',
                    searchterm: '',
                    giphyResults: {},
                    isList: false

                }
            },
            methods: {
                giphySearch ()
                {
                    axios.get( 'https://api.giphy.com/v1/gifs/search?api_key='+myGiphyAPIKey+'&q='+this.searchterm )
                    .then( response => {
                        this.giphyResults = response.data.data;
                    });
                },
                toggleListView ()
                {
                    this.isList = !this.isList;
                },
                giphyImage(images)
                {
                    if ( this.isList === true)
                    {
                        return images.original.url;
                    }
                    else {
                        return images.fixed_width.url;
                    }
                }
            },
            template: `
                <div id="giphy-results">
                    <h1 v-text="apptitle" class="title is-1"></h1>
                    <form @submit.prevent= "giphySearch">
                        <input v-model="searchterm" type="search" class="input">
                        <input type="submit" value="Submit Search" class="input">
                        <button @click="toggleListView" class="input has-text-centered">Toggle Grid/List
                            View</button>
                    </form>
                    <p>Current Search term: {{ searchterm }}</p>
                    <ul class="columns">
                        <li v-for="gif in giphyResults" class="column" v-bind:class="{
                             'is-full' : isList, 'is-one-quarter' : !isList }">
                            <a v-bind:href="gif.url" target="_blank">
                                <img v-bind:src="giphyImage(gif.images)"
                                v-bind:alt="gif.slug">
                            </a>
                        </li>
                    </ul>
                </div>
            `
        } );
            var giphySearch = new Vue( {
                el: '#giphy-search-container'
            } );

        </script>
    </body>
</html>
