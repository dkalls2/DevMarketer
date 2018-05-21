<style scoped>

/* Instead of styling the vue component files in css, we can just stlye it here:
We can do scope styling here. that way all the stuff we style here is scoped to this component
or any of the components that get created from this component.
Only the elements in this component will be styled and not others in the application. 

If we dont have the "scoped" in the element attribute, this styling will affect everything like it does in css.
*/
.slug-widget{
    display: flex;
    justify-content: flex-start;
    align-items: center;
}

.wrapper{
    margin: 8px;
}

.slug{
    background-color:#fdfd96;
    padding: 3px 5px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.input{
    width: auto;
}
.url-wrapper{
    display: flex;
    align-items: center;
    height: 28px;
        /* this is to make the text not move when we click the edit button. */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

#slug-editor {
    min-width: 142px;
    max-width: 300px;
}

</style>




<template>
    
    <div class="slug-widget">
        <!-- a component in vue.js can only have one div, therefore, everything must have a big wrapper.
        In this case, the big wrapper is the slug-widget one above. -->
        <div class="icon-wrapper wrapper">
            <i :class="icon"></i>
            <!-- <i class="fa fa-link"></i> -->
        </div>
        
        <div class="url-wrapper wrapper">
            <span class="root-url">{{urlSanitized}}</span
            ><span class="subdirectory-url">/{{subdirectorySanitized}}/</span
            ><span class="slug" :title="slug" v-show="slug && !isEditing">{{slug}}</span
            ><input type="text" name="slug" id ="slug-editor" class="input is-small" v-show="isEditing" v-model="customSlug" @keyup="adjustWidth" @keydown.esc.prevent @keydown.enter.prevent/>
                <!-- this input field will only show when we are editing -->
                <!-- The input will be tied to customSlug, the main value will be the normal slug.  
                The event that we are triggering whenever the slug changes will then not be triggered when we are editing the customSlug.
                This will prevent some mistakes from happening before we have a chance to validate it. 
                While someone is typing a custom slug, we won't know if it is valid until we run it through our slug compiler.  That is why we want it isolated.-->
            <!-- we need to add the comments after the span tags or move the closing > to next line, 
            otherwise, there will be a space between each span tag displayed.
            this is a weird quirk in html. -->
        </div>

        <div class="button-wrapper wrapper">
            <button class="save-slug-button button is-small" v-show="!isEditing" @click.prevent="editSlug">{{slug.length < 1 ? 'Create New Slug' : 'Edit'}}</button>
            <!-- when people click the edit button, we want an input box to appear with the value of slug in the input box. 
            Then we want to change the edit button into a save button, so we can click to save it and then update the value of the slug.
            Also, once we changed the slug once, we don't want to update it from the title anymore.   
            Then later, we will ad ajax functionality to make sure the slug is unique.
            -->

            <!-- the @click is the vue way of saying v-on, or "on click" and prevent is an event modifer for v-on that is used to prevent propogation -->

            <b-dropdown hoverable v-show="!isEditing && slug.length > 1">
                <button class="save-slug-button button is-small" slot="trigger">
                    <span>Actions</span>
                    <b-icon pack="fa" icon="caret-down"></b-icon>
                </button>
                <b-dropdown-item @click="copyToClipboard(fullUrl)" style="font-size: 0.8em;"><b-icon pack="fa" icon="copy" size="is-small"></b-icon> Copy Full Url</b-dropdown-item>
                <b-dropdown-item @click="copyToClipboard(slug)" style="font-size: 0.8em;"><b-icon pack="fa" icon="copy" size="is-small"></b-icon> Copy Slug</b-dropdown-item>
                <b-dropdown-item has-link style="font-size: 0.8em;">
                    <a :href="fullUrl" target="_blank">
                        <b-icon pack="fa" icon="link" size="is-small"></b-icon>
                        Visit Url
                    </a>
                </b-dropdown-item>
            </b-dropdown>
            
            <button class="save-slug-button button is-small" v-show="isEditing" @click.prevent="saveSlug">{{customSlug == slug ? 'Cancel' : 'Save'}}</button>
            <!-- by default we are not editing, so we do not show this button.  If we are editting, then we show this button. -->

            <button class="save-slug-button button is-small" v-show="isEditing" @click.prevent="resetEditing">Reset</button>
        </div>

    </div>

</template>

<script>
    export default {
        props:{
            //in here, we define any of the properties we want to have.
            url: {
                type: String,
                required: true
                //we could also add a default property, but not if the required is true. 
            },
            subdirectory:{
                type: String,
                required: true
            },
            title: {
                //this is for the slug.  we call it title because we will set up "slug" to be a computed property.
                //title is the title of the blog post.  We will need the title to calculate the slug.
                type: String,
                required: true
            }, 
            icon: {
                type: String,
                default: "fa fa-link"
            }
        },
        data: function(){
            return {
                slug: this.setSlug(this.title),
                isEditing: false,
                customSlug: '',
                wasEdited: false,   
                    //if we edited the title once, we want to remove the ability for the title to automatically create a slug for itself.
                api_token: this.$root.api_token
                    //to go out into our parent component, we use the above code. We grab the api_token from the parent object.
                    //we go to the root object, instead of the parent object, just in case there was a nested component inside a component.  
                    //the root object is on the html template (create.blade.php) in the script section where a vue object is created.
            }
        },
        methods: {
            adjustWidth: function(event) {
                const val = event.target.value;
                const key = event.key;
                if (key === "Escape") {
                    event.preventDefault();
                    this.cancelEditing();
                } else if (key === "Enter") {
                    event.preventDefault();
                    this.saveSlug();
                } else {
                    let canvas = document.createElement('canvas');
                    let ctx = canvas.getContext('2d');
                    ctx.font = "14px sans-serif";
                    document.getElementById('slug-editor').style.width = Math.ceil(ctx.measureText(val).width+25)+"px";
                }
            },
            editSlug: function() {
                this.customSlug = this.slug;
                    //when we edit the slug, it is going to set it equal to the normal slug, so it will look seamless.
                
                this.$emit('edit', this.slug);
                    //this allows us to tie into this event on the front end if we wanted to. We pass in the new value of slug as the second parameter.
                    //this says that we edit the slug
                    //if we wanted to see when someone edited the slug, we could add @edit ="someFunction" to the slug widget in create.blade.php
                
                this.isEditing = true;
                
                window.setTimeout(function () {document.getElementById('slug-editor').focus()}, 0); // must set timeout to wait for the thread to become available

            },
            saveSlug: function() {
                //run ajax to see if new slug is unique
                
                if (this.customSlug !== this.slug){
                    this.wasEdited = true;
                }
                
                this.setSlug(this.customSlug);
                    //now that w ehave the customSlug, we need to run it through our slug function and we need to put it in our normal slug
                    //this way we will trigger the emit slug function below only once instead of after every letter 
                    //and it will only trigger after there is a valid slug instead of inbetween.

                this.$emit('save', this.slug);
                    //this allows us to tie into this event on the front end if we wanted to. We pass in the new value of slug as the second parameter.
                    //this says that we saved the slug
                    //if we wanted to see when someone customized the slug, we could add @save ="someFunction" to the slug widget in create.blade.php

                this.isEditing = false;
            },
            resetEditing: function(){
                this.setSlug(this.title);
                this.$emit('reset', this.slug);
                    //this allows us to tie into this event on the front end if we wanted to. We pass in the new value of slug as the second parameter.
                    //this says that we reset the slug and emit event
                    //if we wanted to see when someone reset the slug, we could add @reset ="someFunction" to the slug widget in create.blade.php
                this.wasEdited = false;
                this.isEditing = false;
            }, 
            setSlug: function (newVal, count = 0){
                //this setter method is so that we do not repeat code.  we only have to set this once.  newVal is the value we want to set the string equal to
                //count is the second variable we want to add and we set it equal to 0 to start.

                if (newVal === '') return '';
                
                //Slugify the newVal
                let slug = Slug(newVal + (count > 0 ? `-${count}` : ''));
                    //this is a new variable that we can reference inside of this function.  This is the current slug we are working with, not the this.slug, which is the universal slug.
                    //we are going to add count to the newVal to make it unique if it is not unique.  if count > 0 then add count, otherwise, just add empty string.
                    //we need to add the `-${count}` around count because this will convert the number into a string.
                let vm = this;
                    //vm = view model. This is an object.  When we get deeper into our functions like promises and "this" does not work anymore, we will reference "this" by vm.

                //test to see if unique (this is our ajax request)
                if (this.api_token && slug) {
                    //we need to test whether the api_token exists and the slug exists before we can run the ajax request because vue will automatically run a method once when ti loads.
                    axios.get('/api/posts/unique', {
                    //we are passing it to the api route and then passing in the parameters as the second argument.
                        params: {
                            api_token: vm.api_token,
                                //we are not inside of laravel.  We are in a vue component.  We don't have access to laravel objects or blade.
                                //vm (or this) is referencing the api_token in the data section above.
                            slug: slug
                        }
                    }).then(function(response) {
                        //if the first part is successful (meaning no errors), then we do this part.

                        //if unique, then set the slug
                        if (response.data) {
                            //response.data represents the response we get from api get request (the returned value from the insomnia request)
                            //if response.data is true, that means the slug is unique.
                            vm.slug = slug;
                            vm.$emit('slug-changed', slug)
                                //slug-changed is the name of the event. The value for the event (2nd parameter) will be the slug.  slug-changed cannot be slugChanged...it cannot be camel case.
                                //this is to trigger an event that goes back to the main vue object in "create.blade.php" that updates the slug.  
                                //WE need to take the value of slug and every time it changes, we need to output it back.
                                //whenever slug changes, we will emit an event.
                        } else {
                            //if not, customize the slug to make it unique and test again
                            vm.setSlug(newVal, count+1)
                        }
                    }).catch(function (error){
                        //if not, do this part
                        console.log(error);
                    });
                }
            },
            copyToClipboard: function(val) {
                let temp = document.createElement('textarea');
                temp.value = val;
                document.body.appendChild(temp);
                temp.select();
                try {
                    let success = document.execCommand('copy');
                    let type = (success ? 'success' : 'warning');
                    let msg = (success ? `Copied to Clipboard: ${val}` : "Copy failed, your browser may not support this feature");
                    this.$emit('copied', type, msg, val);
                    console.log("Copied to Clipboard:", val);
                } catch (err) {
                    this.$emit('copy-failed', val);
                    console.log("Copy failed, your browser may not support this feature.");
                    console.log("Attempted to copy:", val);
                }
                document.body.removeChild(temp);
            }
        },
        computed: {
            urlSanitized: function() {
            return this.url.replace(/^\/|\/$/g, '');
            },
            subdirectorySanitized: function() {
            return this.subdirectory.replace(/^\/|\/$/g, '');
            },
            fullUrl: function() {
            return `${this.urlSanitized}/${this.subdirectorySanitized}/${this.slug}`;
            }
        },
        watch: {
            //this watch property will tell our component to change whenever the things below (title, etc.) are updated. 
            title: _.debounce(function() {
                //Laravel comes wtih low dash (_.).  Debounce is a function of low dash.  It is saying to only run the function every 500 miliseconds at most.
                //if it tries to run multiple times, it will not run it.  It will wait until it has been 500ms since that last request and then it will run it.
                //this saves on the number of times you run an expensive function.  The most expensive functions are API requests.  So it makes the most sense to use debounce for those.
                    
                    if (this.wasEdited == false){
                        this.setSlug(this.title);
                            //this runs the method instead of setting the slug here directly.

                        //run ajax to see if new slug is unique

                        //if not unique, customize the slug to make it unique
                    }
                    
                }, 500)
        }
    }
</script>
