@extends('layouts.manage')

@section('content')
  <div class="flex-container">
    <div class="columns m-t-10 m-b-0">
      <div class="column">
        <h1 class="title is-admin is-4">Add New Blog Post</h1>
      </div>
      <div class="column">
        {{-- <a href="{{route('users.create')}}" class="button is-primary is-pulled-right"><i class="fa fa-user-plus m-r-10"></i> Create New User</a> --}}
      </div>
    </div>
    <hr class="m-t-0">

    <form action="{{route('posts.store')}}" method="post">
      {{ csrf_field() }}
      <div class="columns">
        <div class="column is-three-quarters-desktop is-three-quarters-tablet">
          <b-field>
            <b-input type="text" placeholder="Post Title" size="is-large" v-model="title">
            </b-input>
          </b-field>

          <slug-widget url="{{url('/')}}" subdirectory="blog" :title="title" @copied="slugCopied" @slug-changed="updateSlug"></slug-widget>
            {{-- here we did slug-widget, whereas in the app.js file, we did slugWidget. 
            You use slugWidget when you are working with javascript on the vue side, but this gets 
            automatically convert it to slug-widget here. --}}
            {{-- @slug-changed means the slug-widget is targeting that event in the slugWidget component and we are telling it to run the updateSlug method below --}}
            {{-- we add a colon before title to make it a v-bind --}}
          <input type="hidden" v-model="slug" name="slug" />
              {{-- we may not need this.  it depends on if we are going to submit this as a traditional request or an API request. 
                If you are going to submit this as an API request, as an AJAX request, it does not really matter.
                If you were going to submit this as a normal request, you now have a hidden value called slug that you can reference that will get submitted with the form
                and it will always be equal to whatever we mess around with in the slug-widget url.--}}

          <b-field class="m-t-40">
            <b-input type="textarea"
                placeholder="Compose your masterpiece..." rows="20">
            </b-input>
          </b-field>
        </div> <!-- end of .column.is-three-quarters -->

        <div class="column is-one-quarter-desktop is-narrow-tablet">
          <div class="card card-widget">
            <div class="author-widget widget-area">
              <div class="selected-author">
                <img src="https://placehold.it/50x50"/>
                <div class="author">
                  <h4>Alex Curtis</h4>
                  <p class="subtitle">
                    (jacurtis)
                  </p>
                </div>
              </div>
            </div>
            <div class="post-status-widget widget-area">
              <div class="status">
                <div class="status-icon">
                  <b-icon pack="fa" icon="clipboard" size="is-medium"></b-icon>
                  {{-- assignment --}}
                </div>
                <div class="status-details">
                  <h4><span class="status-emphasis">Draft</span> Saved</h4>
                  <p>A Few Minutes Ago</p>
                </div>
              </div>
            </div>
            <div class="publish-buttons-widget widget-area">
              <div class="secondary-action-button">
                <button class="button is-info is-outlined is-fullwidth">Save Draft</button>
              </div>
              <div class="primary-action-button">
                <button class="button is-primary is-fullwidth">Publish</button>
              </div>
            </div>
          </div>
        </div> <!-- end of .column.is-one-quarter -->
      </div>
    </form>


  </div> <!-- end of .flex-container -->

@endsection

@section('scripts')
  <script>
    //the overall idea is to tie in the "post title" field connect to a vue object/property, below, and we will use that property to tie into our components property (slugWidget)
    var app = new Vue({
      el: '#app',
      data: {
        title: '',
        slug: '',
        api_token: '{{Auth::user()->api_token}}'
          //here we are creating an api_token which the slugWidget will grab.  
          //Normally, you would create an api-property in the slugWidget script and then set the api token in the slug-Widget in the above create.blade.php code.  
          //the preferred way of getting data into your component is using properties. You have a lot better control.
          //In this case, the vue component slugWidget will reach outside of itself, go to this vue parent component, and pull this back in by itself using properties.

      },
      methods: {
        updateSlug: function(val) {
          //val refers to the new slug value, which will be passed in as an argument from the 2nd parameter (this.slug) from the $emit event from the slugWidget component.
          this.slug = val;
            //this is the parent slug.  The child slug is in the slugWidget, which we passed in as val.  We are setting the parent slug to be equal to the child slug.
            //we took the value from the slug inside the component, passed it through an event, and setting it in the parent component.
            //components never know about their parent.  they have their own world and cannot pass up to the parent directly.
        },
        slugCopied: function(type, msg, val) {
          notifications.toast(msg, {type: `is-${type}`});
        }
      }
    });
  </script>
@endsection