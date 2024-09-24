<script>
import WebLayout from '@/Layouts/WebLayout.vue';
import { Head } from '@inertiajs/vue3';

export default {
  components: {
    WebLayout,
    Head,
  },
  data() {
    return {
      items: [
        {
          title: 'Step: You submit an application',
          description: `You submit an application for the procedure to be carried out (in writing, online or by telephone). Make sure that you provide the necessary information on the application form. Only then can we process your application quickly. In the case of consumer disputes, the company bears the costs of the procedure.`,
        },{
          title: 'Step: We review your application',
          description: `'We review your application in terms of form and content`,
        },{
          title: 'Step: We initiate the dispute resolution procedure',
          description: `If the respondent has already given their consent to the procedure being carried out, we appoint a mediator and the procedure (depending on the case, as a mediation or arbitration procedure) can begin.<br/>
          If there is no consent, we submit your application to the respondent. If the respondent agrees to the procedure, we appoint the mediator and initiate the procedure (depending on the case, as a mediation or arbitration procedure).`,
        },{
          title: 'Step: We carry out the procedure together with the parties',
          description: `The aim of the dispute resolution procedure is to reach an amicable solution. In the case of arbitration proceedings, we mediate and propose a solution. But we do not decide! <br>
          The dispute resolution procedure can be conducted in writing, online, by telephone or in a direct personal meeting. The negotiation can be prepared by written submissions. The mediator ensures that the dispute resolution procedure runs smoothly.`,
        },{
          title: 'Step: The procedure ends with or without agreement',
          description: `The dispute resolution procedure ends either with a successful agreement or with a declaration that the procedure has failed. In this case, you have legal recourse.`,
        },
      ],
    };
  },
};
</script>

<template>
  <Head title="Services" />
  <WebLayout>
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
      
      <a-typography-title :level="1">Our Approach</a-typography-title>
      <a-typography-title :level="4">The procedure - an overview</a-typography-title>
      <p>The procedure is transparent and precisely regulated in the procedural rules. It follows simple, understandable steps. The expected average duration of the procedure is 90 days</p>
      <!--
      <a-steps
        direction="vertical"
        :current="null"
        :items="items"
      ></a-steps>
      -->
      <a-timeline>
        <a-timeline-item>
          <a-typography-title :level="4">Step 1: You submit an application</a-typography-title>
          <p>You submit an application for the procedure to be carried out (in writing, online or by telephone). Make sure that you provide the necessary information on the application form. Only then can we process your application quickly. In the case of consumer disputes, the company bears the costs of the procedure.</p>
        </a-timeline-item>
        <a-timeline-item>
          <a-typography-title :level="4">Step 2: We review your application</a-typography-title>
          <p>We review your application in terms of form and content</p>
        </a-timeline-item>
        <a-timeline-item>
          <a-typography-title :level="4">Step 3: We initiate the dispute resolution procedure</a-typography-title>
          <p>If the respondent has already given their consent to the procedure being carried out, we appoint a mediator and the procedure (depending on the case, as a mediation or arbitration procedure) can begin.</p>
          <p>If there is no consent, we submit your application to the respondent. If the respondent agrees to the procedure, we appoint the mediator and initiate the procedure (depending on the case, as a mediation or arbitration procedure).</p>
        </a-timeline-item>
        <a-timeline-item>
          <a-typography-title :level="4">Step 4: We carry out the procedure together with the parties</a-typography-title>
          <p>The aim of the dispute resolution procedure is to reach an amicable solution. In the case of arbitration proceedings, we mediate and propose a solution. But we do not decide!</p>
          <p>The dispute resolution procedure can be conducted in writing, online, by telephone or in a direct personal meeting. The negotiation can be prepared by written submissions. The mediator ensures that the dispute resolution procedure runs smoothly.</p>
        </a-timeline-item>
        <a-timeline-item>
          <a-typography-title :level="4">Step 5: The procedure ends with or without agreement</a-typography-title>
          <p>The dispute resolution procedure ends either with a successful agreement or with a declaration that the procedure has failed. In this case, you have legal recourse.</p>
        </a-timeline-item>
      </a-timeline>
      <p>If an agreement is reached, this is recorded in writing and approved by the parties.</p>
    </div>
  </WebLayout>
</template>
