<template>
    <div>
        <div class="profile-timeline">
            <div class="m-timeline-2">
                <div class="m-timeline-2__items">
                    <div class="m-timeline-2__item">
                        <span class="m-timeline-2__item-time">2020 Jan</span>
                        <div class="m-timeline-2__item-cricle">
                            <i class="fa fa-genderless m--font-info"></i>
                        </div>
                        <div class="m-timeline-2__item-text  m--padding-top-5">
                            <div class="profile-timeline__content">
                                <div class="row">
                                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                                        <h4 class="profile-timeline__title">FINAL BOSS</h4>
                                    </div>
                                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
                                        <p class="profile-timeline__text">
                                            Coordinate with designers and developers to develop various new products and features along with various interactive designs
                                            within required timeframe. Develop new business initiatives in coordination with UE team and
                                            design various methodologies and practices for innovative interactive technologies and perform
                                            quality assurance and browser computability tests. Design style sheets for website and assist
                                            application programmers in effective implementation and ensure all work according to scripting
                                            code with help of various technologies. Collaborate with designers and application developer
                                            to develop various customized websites. Prepare all production documents on Photoshop and translate
                                            same into HTML templates with help of developers and designers and facilitate to introduce new
                                            features into same.
                                        </p>
                                    </div>
                                </div>
                                <user-career-milestone></user-career-milestone>
                                <div class="row">
                                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                                        <div class="profile-timeline__notes">
                                        </div>
                                    </div>
                                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
                                        <div class="profile-timeline__action">
                                            <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">Edit</button>
                                            <button type="button" class="btn m-btn--pill btn-success m-btn m-btn--custom">Apply as current</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "CareerModal",
        data(){
            return{
                isHidden:false,

            }
        },

    }
</script>

<style scoped>

</style>