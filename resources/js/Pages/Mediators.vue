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
      topMediators: [
        { 
          name: 'Dr. Sarah Johnson', 
          specialization: 'Family Mediation', 
          experience: '15 years', 
          avatar: 'https://randomuser.me/api/portraits/women/1.jpg', 
          background: 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80',
          introduction: 'Dr. Johnson specializes in resolving complex family disputes with empathy and expertise. Her approach focuses on creating harmonious solutions for all parties involved.'
        },
        { 
          name: 'Michael Chen', 
          specialization: 'Commercial Disputes', 
          experience: '20 years',  
          avatar: 'https://randomuser.me/api/portraits/men/2.jpg', 
          background: 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80',
          introduction: 'With a strong background in business law, Michael excels in navigating intricate commercial conflicts. He is known for his strategic thinking and ability to find win-win solutions.'
        },
        { 
          name: 'Emily Rodriguez', 
          specialization: 'Workplace Conflicts', 
          experience: '12 years', 
          avatar: 'https://randomuser.me/api/portraits/women/3.jpg', 
          background: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80',
          introduction: 'Emily is passionate about fostering positive work environments. Her mediation style emphasizes open communication and collaborative problem-solving in workplace disputes.'
        },
        { 
          name: 'David Patel', 
          specialization: 'International Arbitration', 
          experience: '18 years', 
          avatar: 'https://randomuser.me/api/portraits/men/4.jpg', 
          background: 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80',
          introduction: 'David brings a wealth of experience in international law to his arbitration practice. He is skilled in handling multi-jurisdictional disputes with cultural sensitivity and legal acumen.'
        },
      ],
      servicesTeam: [
        { 
          name: 'Amanda Lee', 
          role: 'Client Relations Manager',
          intro: 'Amanda excels in building strong relationships with clients, ensuring their needs are met throughout the mediation process. With her background in psychology, she provides empathetic support to all parties involved.',
          avatar: 'https://randomuser.me/api/portraits/women/5.jpg'
        },
        { 
          name: 'Robert Kim', 
          role: 'Case Assessment Specialist',
          intro: `Robert's analytical skills and legal expertise allow him to quickly assess complex cases and recommend the most suitable mediation approaches. His insights are invaluable in preparing for successful mediations.`,
          avatar: 'https://randomuser.me/api/portraits/men/6.jpg'
        },
        { 
          name: 'Olivia Thompson', 
          role: 'Mediation Coordinator',
          intro: `Olivia's exceptional organizational skills keep our mediation processes running smoothly. She coordinates all aspects of mediation sessions, ensuring efficient and effective proceedings for all parties.`,
          avatar: 'https://randomuser.me/api/portraits/women/7.jpg'
        },
        { 
          name: 'James Wilson', 
          role: 'Legal Liaison',
          intro: `With his extensive legal background, James bridges the gap between mediation and legal processes. He ensures all our services comply with current regulations and provides crucial legal insights when needed.`,
          avatar: 'https://randomuser.me/api/portraits/men/8.jpg'
        },
      ],
    };
  },
};
</script>

<template>
  <Head title="Mediators" />
  <WebLayout>
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
      <a-typography-title :level="1">Our Expert Mediators</a-typography-title>
      
      <a-typography-title :level="2" class="mt-8">Top Mediators</a-typography-title>
      <a-row :gutter="[16, 16]">
        <a-col :span="12" v-for="mediator in topMediators" :key="mediator.name">
          <a-card hoverable :bodyStyle="{ padding: 0 }">
            <div class="relative">
              <img :src="mediator.background" :alt="mediator.name + ' background'" class="w-full h-48 object-cover" />
              <div class="absolute inset-0 bg-black bg-opacity-40"></div>
              <div class="absolute bottom-0 left-0 p-4 flex items-center">
                <a-avatar :size="64" :src="mediator.avatar" />
                <div class="ml-4 text-white">
                  <h3 class="text-lg font-semibold">{{ mediator.name }}</h3>
                  <p class="text-sm">{{ mediator.specialization }}</p>
                </div>
              </div>
            </div>
            <div class="p-4">
              <p class="text-sm text-gray-600 mb-2">Experience: {{ mediator.experience }}</p>
              <p class="text-sm text-gray-800">{{ mediator.introduction }}</p>
            </div>
          </a-card>
        </a-col>
      </a-row>

      <a-typography-title :level="2" class="mt-12">Our Services Team</a-typography-title>
      <a-row :gutter="[16, 16]">
        <a-col :span="12" v-for="member in servicesTeam" :key="member.name">
          <a-card hoverable>
            <a-card-meta :title="member.name" :description="member.role">
              <template #avatar>
                <a-avatar :src="member.avatar" :size="64" />
              </template>
            </a-card-meta>
            <p class="mt-4 text-sm text-gray-600">{{ member.intro }}</p>
          </a-card>
        </a-col>
      </a-row>
    </div>
  </WebLayout>
</template>
