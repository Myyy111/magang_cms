import Vue from 'vue';
import TeamSection from './components/TeamSection.vue';

if (document.getElementById('team-section-root')) {
    console.log('Mounting team section...');
    console.log('Members data:', window.TEAM_MEMBERS);
    new Vue({
        el: '#team-section-root',
        components: { TeamSection },
        data() {
            return {
                members: window.TEAM_MEMBERS || []
            }
        },
        template: '<TeamSection :members="members" />'
    });
}
