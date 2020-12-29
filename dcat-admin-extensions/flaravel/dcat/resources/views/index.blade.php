<div class="{{$viewClass['form-group']}}">

    <label class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')

        <div {!! $attributes !!} style="width: 100%; height: 100%;">
            <div class="card">
                <div class="card-body">
                    <section>
                        <div v-for="(item, index) in specification" :key="index" class="spec-line">
                            <div class="mb-1">
                                <span v-if="!cacheSpecification[index].status">@{{ item.name }}</span>
                                <div class="input-group mb-1" v-if="cacheSpecification[index].status">
                                    <div class="input-group-prepend" @click="saveSpec(index)">
                                        <span class="input-group-text"><i class="feather icon-check"></i></span>
                                    </div>
                                    <input type="text" class="form-control" v-model="cacheSpecification[index].name" placeholder="输入产品规格" @keyup.native.enter="saveSpec(index)">
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-sm-3 input-group mb-2"
                                         v-for="(tag, j) in item.value" :key="j"
                                    >
                                        <input type="text"
                                               class="form-control"
                                               :value="tag"
                                        >
                                        <div class="input-group-append">
                                            <span style="cursor: pointer" class="input-group-text"><i class="feather icon-x"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3" style="width: 22%;cursor: pointer" @click="addSpecTag(index)">
                                <input type="text" class="form-control" v-model="addValues[index]" @keyup.native.enter="addSpecTag(index)" placeholder="多个产品属性以空格隔开">
                                <div class="input-group-append">
                                    <span class="input-group-text" ><i class="feather icon-check"></i></span>
                                </div>
                            </div>
                            <i class="icon el-icon-circle-close spec-deleted" @click="delSpec(index)"></i>
                        </div>
                    </section>
                </div>
                <div class="card-footer">
                    <button type="button" :disabled="specification.length >= 5" class="btn btn-primary btn-sm" @click="addSpec">添加规格值</button>
                </div>
            </div>
        </div>

        <input type="hidden" name="{{$name}}" value="{{ old($column, $value) }}" />

        @include('admin::form.help-block')
    </div>
</div>

<script init="{!! $selector !!}">
// 为Object添加一个原型方法，判断两个对象是否相等
function objEquals (object1, object2) {
    // For the first loop, we only check for types
    for (let propName in object1) {
        // Check for inherited methods and properties - like .equals itself
        // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/hasOwnProperty
        // Return false if the return value is different
        if (object1.hasOwnProperty(propName) !== object2.hasOwnProperty(propName)) {
            return false
            // Check instance type
        } else if (typeof object1[propName] !== typeof object2[propName]) {
            // Different types => not equal
            return false
        }
    }
    // Now a deeper check using other objects property names
    for (let propName in object2) {
        // We must check instances anyway, there may be a property that only exists in object2
        // I wonder, if remembering the checked values from the first loop would be faster or not
        if (object1.hasOwnProperty(propName) !== object2.hasOwnProperty(propName)) {
            return false
        } else if (typeof object1[propName] !== typeof object2[propName]) {
            return false
        }
        // If the property is inherited, do not check any more (it must be equa if both objects inherit it)
        if (!object1.hasOwnProperty(propName)) {
            continue
        }
        // Now the detail check and recursion
        // This returns the script back to the array comparing
        /** REQUIRES Array.equals**/
        if (object1[propName] instanceof Array && object2[propName] instanceof Array) {
            // recurse into the nested arrays
            if (objEquals(!object1[propName], object2[propName])) {
                return false
            }
        } else if (object1[propName] instanceof Object && object2[propName] instanceof Object) {
            // recurse into another objects
            // console.log("Recursing to compare ", this[propName],"with",object2[propName], " both named \""+propName+"\"");
            if (objEquals(!object1[propName], object2[propName])) {
                return false
            }
            // Normal value comparison for strings and numbers
        } else if (object1[propName] !== object2[propName]) {
            return false
        }
    }
    // If everything passed, let's say YES
    return true
}
var vm = new Vue({
    el: '#' + id,
    data() {
        return {
            specificationStatus: false, // 显示规格列表
            // 规格
            specification: [],
            // 子规格
            childProductArray: [],
            // 用来存储要添加的规格属性
            addValues: [],
            // 默认商品编号
            defaultProductNo: 'PRODUCTNO_',
            // 批量设置相关
            isSetListShow: true,
            batchValue: '', // 批量设置所绑定的值
            currentType: '', // 要批量设置的类型
            cacheSpecification: [] // 缓存规格名称
        }
    },
    computed: {
        // 所有sku的id
        stockSpecArr () {
            return this.childProductArray.map(item => item.childProductSpec)
        }
    },
    created() {
        this.createData()
    },
    methods: {
        // 创建模拟数据
        createData() {
            const arr = ['颜色', '尺寸']
            const arr2 = ['黑色 白色 蓝色 红色', 's m xl']
            for (let i = 0; i < 2; i++) {
                // 添加数据
                this.addSpec()
                // 数据
                this.specification[i].name = arr[i]
                this.addValues[i] = arr2[i]
                // 缓存按钮键值
                this.cacheSpecification[i].status = false
                this.cacheSpecification[i].name = arr[i]
                // 构建
                this.addSpecTag(i)
            }
        },
        // 添加规格项目
        addSpec () {
            if (this.specification.length < 5) {
                this.cacheSpecification.push({
                    status: true,
                    name: ''
                })
                this.specification.push({
                    name: '',
                    value: []
                })
            }
        },
        // 添加规格属性
        addSpecTag (index) {
            alert(index)
            let str = this.addValues[index] || ''
            if (!str.trim() || !this.cacheSpecification[index].name.trim()) {
                this.$message.error('名称不能为空，请注意修改')
                return
            } // 判空
            str = str.trim()
            let arr = str.split(/\s+/) // 使用空格分割成数组
            let newArr = this.specification[index].value.concat(arr)
            newArr = Array.from(new Set(newArr)) // 去重
            this.$set(this.specification[index], 'value', newArr)
            this.clearAddValues(index)
            this.handleSpecChange('add')
            this.specification[index].name = this.cacheSpecification[index].name
            this.cacheSpecification[index].status = false
        },

        // 清空 addValues
        clearAddValues (index) {
            this.$set(this.addValues, index, '')
        },

        /**
         * [handleSpecChange 监听标签的变化,当添加标签时；求出每一行的hash id，再动态变更库存信息；当删除标签时，先清空已有库存信息，然后将原有库存信息暂存到stockCopy中，方便后面调用]
         * @param  {[string]} option ['add'|'del' 操作类型，添加或删除]
         * @return {[type]}        [description]
         */
        handleSpecChange (option) {
            const stockCopy = JSON.parse(JSON.stringify(this.childProductArray))
            if (option === 'del') {
                this.childProductArray = []
            }
            for (let i = 0; i < this.countSum(0); i++) {
                this.changeStock(option, i, stockCopy)
            }
        },

        /*
            计算属性的乘积
            @params
         specIndex 规格项目在 advancedSpecification 中的序号
        */
        countSum (specIndex) {
            let num = 1
            this.specification.forEach((item, index) => {
                if (index >= specIndex && item.value.length) {
                    num *= item.value.length
                }
            })
            return num
        },

        /**
         * [根据规格，动态改变库存相关信息]
         * @param  {[string]} option    ['add'|'del' 操作类型，添加或删除]
         * @param  {[array]} stockCopy [库存信息的拷贝]
         * @return {[type]}           [description]
         */
        changeStock (option, index, stockCopy) {
            let childProduct = {
                childProductId: 0,
                childProductSpec: this.getChildProductSpec(index),
                childProductNo: this.defaultProductNo + index,
                childProductStock: 0,
                childProductPrice: 0,
                childProductCost: 0,
                isUse: true
            }
            const spec = childProduct.childProductSpec
            if (option === 'add') {
                // 如果此id不存在，说明为新增属性，则向 childProductArray 中添加一条数据
                if (this.stockSpecArr.findIndex((item) => objEquals(spec, item)) === -1) {
                    this.$set(this.childProductArray, index, childProduct)
                }
            } else if (option === 'del') {
                // 因为是删除操作，理论上所有数据都能从stockCopy中获取到
                let origin = ''
                stockCopy.forEach(item => {
                    if (objEquals(spec, item.childProductSpec)) {
                        origin = item
                        return false
                    }
                })
                this.childProductArray.push(origin || childProduct)
            }
        },
        // 获取childProductArray的childProductSpec属性
        getChildProductSpec (index) {
            let obj = {}
            this.specification.forEach((item, specIndex) => {
                obj[item.name] = this.getSpecAttr(specIndex, index)
            })
            return obj
        },
        /*
        根据传入的属性值，拿到相应规格的属性
        @params
         specIndex 规格项目在 advancedSpecification 中的序号
         index 所有属性在遍历时的序号
        */
        getSpecAttr (specIndex, index) {
            // 获取当前规格项目下的属性值
            const currentValues = this.specification[specIndex].value
            let indexCopy
            // 判断是否是最后一个规格项目
            if (this.specification[specIndex + 1] && this.specification[specIndex + 1].value.length) {
                indexCopy = index / this.countSum(specIndex + 1)
            } else {
                indexCopy = index
            }
            const i = Math.floor(indexCopy % currentValues.length)
            if (i.toString() !== 'NaN') {
                return currentValues[i]
            } else {
                return ''
            }
        },
    }
})
</script>
